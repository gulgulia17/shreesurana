<?php

namespace App\DataTables;

use App\Models\Data;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use function GuzzleHttp\Promise\each;

class LeadsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $response = Response::all();
        return datatables()
            ->eloquent($query)
            ->filterColumn('companies.id', function ($query, $keyword) {
                $query->where('company_id', $keyword);
            })
            ->orderColumn('companies.id', function ($query, $order) {
                $query->join('companies as company', 'company.id', '=', 'data.company_id')
                    ->orderBy('company.name', $order)
                    ->select('data.*')
                    ->with('companies');
            })
            ->addColumn('action', function (Data $data) use ($response) {
                return view('pages.leads.action', ['data' => $data, 'responses' => $response]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Data $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Data $model)
    {
        return $model->whereDoesntHave('lead')->whereHas('users', function ($query) {
            $query->where('user_id', auth()->id());
        })->with('companies')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('leads-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-6'B><'col-md-6'f>><'row'<'col-md-12'tr>><'row'<'col-md-6'l><'col-md-6'p>>")
            ->orderBy(0, 'asc')
            ->buttons(
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('number'),
            Column::make('companies.name', 'companies.id')
                ->title('Company Name')
                ->addClass('w-25'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Leads_' . date('YmdHis');
    }
}
