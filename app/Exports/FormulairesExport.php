<?php

namespace App\Exports;

use App\Models\Formulaire;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;


class FormulairesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Formulaire::all()->makeHidden(['updated_at']);
    }



    public function headings(): array
    {
        return [
            "ID",
            "Quel circuit avez-vous suivi",
            "Comment évaluez-vous votre expérience globale",
            "Qu'avez-vous le plus apprécié durant la visite",
            "Avez-vous rencontré des difficultés pendant la visite",
            "Avez-vous des suggestions pour améliorer les prochaines éditions",
            "où avez-vous entendu parler de nous",
            "Intéressé d'étre contacté",
            "Contact",
            "Langue Choisie",
            "Créé le",
        ];
    }

    public function map($form): array
    {
        return [
            $form->id,
            $form->circuit,
            $form->evaluation . "/5",
            $this->stringing($form->appreciation),
            $form->difficulty,
            $form->suggestion,
            $this->stringing($form->source),
            $form->interested,
            $this->stringing($form->contact),
            $form->language,
            $form->created_at,
        ];
    }


    private function stringing($array)
    {
        $filtered = array_filter($array, function ($value) {
            return !is_null($value) && strpos($value, 'non') === false;
        });

        $string = implode(', ', $filtered);

        return $string;
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();

        for ($row = 2; $row <= $highestRow; $row++) {
            $color = $row % 2 == 0 ? 'FFFFFF' : 'E8E8E8';

            $sheet->getStyle("A{$row}:Z{$row}")
                ->applyFromArray([
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['argb' => $color],
                    ],
                ]);
        }

        return [
            1    => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFF'],

                ],
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['argb' => Color::COLOR_ALPHA],
                ],

            ],
        ];
    }
}
