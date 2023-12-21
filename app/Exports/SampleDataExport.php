<?php

namespace App\Exports;

use App\Models\SampleData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SampleDataExport implements FromCollection, WithMapping, WithHeadings
{
    protected $columns;
    protected $selectedRowsExcel;

    public function __construct($columns, $selectedRowsExcel)
    {
        $this->columns = $columns;
        $this->selectedRowsExcel = $selectedRowsExcel;
    }

    public function collection()
    {
        return SampleData::whereIn('id', $this->selectedRowsExcel)->get();
    }

    public function map($data): array
    {
        $mappedData = [];

        foreach ($this->columns as $column) {
            switch ($column) {
                case 'id':
                    $mappedData[] = $data->id;
                    break;
                case 'client':
                    $mappedData[] = $data->client;
                    break;
                case 'projet':
                    $mappedData[] = $data->Projet;
                    break;
                case 'constat':
                    $mappedData[] = $data->constat;
                    break;
                case 'recommandations':
                    $mappedData[] = $data->recommandations;
                    break;
                case 'departement':
                    $mappedData[] = $data->departement;
                    break;
                case 'risque':
                    $mappedData[] = $data->risque;
                    break;
                case 'priorite':
                    $mappedData[] = $data->priorite;
                    break;
                case 'commentaire_management':
                    $mappedData[] = $data->etat->correcteur->commentaire_management;
                    break;    
                case 'avancement':
                    $mappedData[] = $data->etat->correcteur->avancement;
                    break;
            }
        }
        return $mappedData;
    }

    public function headings(): array
    {
        $headings = [];

        foreach ($this->columns as $column) {
            switch ($column) {
                case 'id':
                    $headings[] = 'ID';
                    break;
                case 'client':
                    $headings[] = 'Client';
                    break;
                case 'projet':
                    $headings[] = 'Projet';
                    break;
                case 'constat':
                    $headings[] = 'Constat';
                    break;
                case 'recommandations':
                    $headings[] = 'Recommandations';
                    break;
                case 'departement':
                    $headings[] = 'Departement';
                    break;
                case 'risque':
                    $headings[] = 'Risque';
                    break;
                case 'priorite':
                    $headings[] = 'Priorité';
                    break;
                case 'commentaire_management':
                    $headings[] = 'Commentaire Management';
                    break;
                case 'avancement':
                    $headings[] = 'Etat d\'avancement';
                    break;
            }
        }

        return $headings;
    }
}
