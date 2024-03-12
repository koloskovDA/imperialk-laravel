<div>
    <div class="card">
        <div class="card-header">
            @if (!$createUrl)
                <button type="button" wire:click="createInstance" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                    Создать {{strtolower($classLabel)}}
                </button>
            @else
                <a href="{{$createUrl}}" class="btn btn-success">Создать {{strtolower($classLabel)}}</a>
            @endif
        </div>

        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6">

                    </div>
                    <div class="col-sm-12 col-md-6">

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                            <thead>
                            <tr>
                                @foreach($propertiesLabels as $label)
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                        {{$label}}
                                    </th>
                                @endforeach
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">

                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd">
                                @foreach($properties as $label)
                                    <td class="dtr-control sorting_1" tabindex="0">
                                        @if(array_key_exists($label, $search))
                                            <input class="form-control" type="search" wire:model.live="search.{{$label}}" placeholder="Поиск" aria-label="Поиск">
                                        @endif
                                    </td>
                                @endforeach
                                <td>
                                </td>
                            </tr>
                            @foreach($collection as $item)
                                <tr class="odd">
                                    @foreach($properties as $key => $property)
                                        <td class="dtr-control sorting_1" tabindex="0">
                                            @if ($key == 0 && $showUrl)
                                                <a href="{{str_replace('{id}', $item->id, $showUrl)}}">{{ $item->{$property} }}</a>
                                            @else
                                                {{ $item->{$property} }}
                                            @endif
                                        </td>
                                    @endforeach
                                    <td>
                                        <!--<button class="btn btn-sm btn-light"><i class="far fa-fw fa-eye"></i></button>-->
                                        @if (!$editUrl)
                                            <button class="btn btn-sm btn-light" data-toggle="modal" data-target="#modal-edit" wire:click="editInstance({{$item}})">
                                                <i class="fas fa-fw fa-pencil"></i>
                                            </button>
                                        @else
                                            <a href="{{$editUrl}}" class="btn btn-sm btn-light"><i class="fas fa-fw fa-pencil"></i></a>
                                        @endif
                                        <button class="btn btn-sm btn-light" data-toggle="modal" data-target="#modal-sm" wire:click="deleteInstance({{$item}})">
                                            <i class="far fa-fw fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                            {{ $collection->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!$createUrl)
        <div class="modal fade" wire:ignore.self id="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Создать {{$classLabel}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($inputTypes as $key => $inputType)
                        @if ($inputType !== 'select')
                            <div class="form-group">
                                <label for="">{{$propertiesLabels[$key]}}</label>
                                <input class="form-control" wire:model="values.{{$key}}" type="{{$inputType}}">
                                @error('values.'.$key) <span class="error">{{ $message }}</span> @enderror
                            </div>
                        @else
                            <div class="form-group">
                                <label for="">{{$propertiesLabels[$key]}}</label>
                                <select wire:model="values.{{$key}}" class="custom-select">
                                    @foreach($enums[$key] as $enumKey => $enumValue)
                                        <option value="{{$enumKey}}">{{$enumValue}}</option>
                                    @endforeach
                                </select>
                                @error('values.'.$key) <span class="error">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" wire:click="confirmCreate">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(!$editUrl)
        <div class="modal fade" wire:ignore.self id="modal-edit" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Изменить {{$classLabel}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($inputTypes as $key => $inputType)
                        @if ($inputType !== 'select')
                            <div class="form-group">
                                <label for="">{{$propertiesLabels[$key]}}</label>
                                <input class="form-control" wire:model="values.{{$key}}" type="{{$inputType}}">
                                @error('values.'.$key) <span class="error">{{ $message }}</span> @enderror
                            </div>
                        @else
                            <div class="form-group">
                                <label for="">{{$propertiesLabels[$key]}}</label>
                                <select wire:model="values.{{$key}}" class="custom-select">
                                    @foreach($enums[$key] as $enumKey => $enumValue)
                                        <option value="{{$enumKey}}">{{$enumValue}}</option>
                                    @endforeach
                                </select>
                                @error('values.'.$key) <span class="error">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" wire:click="confirmEdit">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="modal fade" wire:ignore.self id="modal-sm" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Удалить {{strtolower($classLabel)}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить {{$classLabel}}?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" wire:click="confirmDelete">Удалить</button>
                </div>
            </div>
        </div>
    </div>
</div>
