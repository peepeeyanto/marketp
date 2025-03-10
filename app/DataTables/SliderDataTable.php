<?php

namespace App\DataTables;

use App\Models\slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                $editBtn = "<a href='".route('admin.slider.edit', $query->id)."' class='btn btn-primary mb-2'>edit</a>";
                $deleteBtn = "<a href='".route('admin.slider.destroy', $query->id)."' class='btn btn-danger delete-item'>delete</a>";
                return $editBtn.$deleteBtn;
            })
            ->addColumn('banner', function($query){
                return $img = "<img width='100px' src='".asset($query->banner)."'></img>";
            })
            ->addColumn('status', function($query){
                $active = "<i class='badge badge-success'>active</i>";
                $inactive = "<i class='badge badge-danger'>inactive</i>";
                if($query->status == 1){
                    return $active;
                }else{
                    return $inactive;
                }
            })
            ->rawColumns(['banner', 'action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('slider-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->width(50),
            Column::make('banner')->width(200),
            Column::make('type')->width(50),
            Column::make('title')->width(100),
            Column::make('startPrice')->width(100),
            Column::make('serial')->width(100),
            Column::make('status')->width(50),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Slider_' . date('YmdHis');
    }
}
