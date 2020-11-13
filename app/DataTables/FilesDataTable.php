<?php

namespace App\DataTables;

use App\Models\File;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FilesDataTable extends DataTable
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
        ->addColumn('action', function(File $file){
            return view('admin.filemanager.action',compact('file'));
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\File $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(File $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->parameters([
                        'initComplete' => 'function() { 
                            $(".file-attach").click(function (e) { 
                                e.preventDefault();
                                let url = $(this).attr("href");
                                let modal = $("#files-attach-modal");
                                $.ajax({
                                    type: "GET",
                                    url: url,
                                    success: function (response) {
                                        $("#file-attach-form").attr("action",url);
                                        modal.modal("show");
                                        if (response.users.length) {
                                            $("#user").children().each(function (index, element) {
                                                 $(element).remove();
                                             });
                                        }
                                        $(".total").val(response.total);
                                        $.each(response.users, function (i,v) { 
                                            $("#user").append(`<option value="${v.id}">${v.name}</option>`);
                                         }); 
                                    }
                                });
                           });
                         }',
                    ])
                    ->setTableId('files-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom("<'row'<'col-md-4'l><'col-md-4 text-center'B><'col-md-4'f>><'row'<'col-md-12'tr>><'row'<'col-md-6'i><'col-md-6'p>>")
                    ->orderBy(0)
                    ->buttons(
                        Button::make('excel'),
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
            Column::make('description'),
            Column::computed('action')
                  ->exportable(true)
                  ->printable(true)
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
        return 'Files_' . date('YmdHis');
    }
}
