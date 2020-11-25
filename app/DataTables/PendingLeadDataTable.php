<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Lead;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PendingLeadDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($lead) {
                return view('pages.leads.action', [
                    'data' => $lead->data,
                    'responses' => \App\Models\Response::all()
                ]);
            })
            ->editColumn('response.name', function ($value) {
                return "<span class='px-3 py-2' style='background-color: {$value->response->color};'>{$value->response->name}</span>";
            })
            ->editColumn('remark', function ($value) {
                return "<span class='bg-info px-3 py-2'>{$value->remark}</span>";
            })
            ->escapeColumns('response.name')
            ->escapeColumns('remark');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Lead $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Lead $model)
    {
        return $model->with('response', 'data')->where('closed', 0)
            ->where('later', '<', Carbon::now()->format('Y-m-d H:i:s'))
            ->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('pendinglead-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-6'B><'col-md-6'f>><'row'<'col-md-12'tr>><'row'<'col-md-6'l><'col-md-6'p>>")
            ->orderBy(0, 'asc')
            ->buttons(
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
            Column::computed('data.name', 'Name')
                ->sortable(true),
            Column::computed('data.number', 'Number')
                ->sortable(true),
            Column::computed('response.name', 'Previos Response')
                ->sortable(true),
            Column::make('remark'),
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
        return 'PendingLead_' . date('YmdHis');
    }
}
