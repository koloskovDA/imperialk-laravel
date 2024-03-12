<div>
<div class="card">
    <div class="card-header">
        <button type="button" wire:click="showModal" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
            Создать
        </button>
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
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                Название
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                Начало закрытия
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                Окончание закрытия
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                Статус
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="odd">
                            <td class="dtr-control sorting_1" tabindex="0">
                                <input class="form-control" type="search" name="adminlteSearch" placeholder="Поиск" aria-label="Поиск">
                            </td>
                            <td>
                                <input class="form-control" type="search" name="adminlteSearch" placeholder="Поиск" aria-label="Поиск">
                            </td>
                            <td>
                                <input class="form-control" type="search" name="adminlteSearch" placeholder="Поиск" aria-label="Поиск">
                            </td>
                            <td>
                                <input class="form-control" type="search" name="adminlteSearch" placeholder="Поиск" aria-label="Поиск">
                            </td>
                            <td>
                            </td>
                        </tr>
                        @foreach($auctions as $auction)
                            <tr class="odd">
                                <td class="dtr-control sorting_1" tabindex="0">
                                    <a href="/admin/auctions/{{$auction->id}}/lots">{{$auction->name}}</a>
                                </td>
                                <td>
                                    {{Carbon\Carbon::parse($auction->closing_at)->translatedFormat('d F Y, H:i:s')}}
                                </td>
                                <td>
                                    {{Carbon\Carbon::parse($auction->closing_end)->translatedFormat('d F Y, H:i:s')}}
                                </td>
                                <td>
                                    {{\App\Enums\AuctionStatusEnum::from($auction->visibility)->label}}
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-light"><i class="far fa-fw fa-eye"></i></button>
                                    <button class="btn btn-sm btn-light" data-toggle="modal" data-target="#modal-edit" wire:click="editAuction({{$auction}})">
                                        <i class="fas fa-fw fa-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-light" data-toggle="modal" data-target="#modal-sm" wire:click="deleteAuction({{$auction}})">
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
                        <ul class="pagination">
                            <li class="paginate_button page-item previous disabled" id="example2_previous">
                                <a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">
                                    Previous
                                </a>
                            </li>
                            <li class="paginate_button page-item active">
                                <a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                            </li>
                            <li class="paginate_button page-item ">
                                <a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                            </li>
                            <li class="paginate_button page-item ">
                                <a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                            </li>
                            <li class="paginate_button page-item ">
                                <a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a>
                            </li>
                            <li class="paginate_button page-item ">
                                <a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a>
                            </li>
                            <li class="paginate_button page-item ">
                                <a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a>
                            </li>
                            <li class="paginate_button page-item next" id="example2_next">
                                <a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    <div class="modal fade" wire:ignore.self id="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Создание аукциона</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Название</label>
                        <input class="form-control" wire:model="name" type="search" name="adminlteSearch" placeholder="Поиск" aria-label="Поиск">
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Дата закрытия</label>
                        <input class="form-control" wire:model="closing_at" type="datetime-local">
                        @error('closing_at') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Статус</label>
                        <select wire:model="visibility" class="custom-select">
                            <option value="hidden">Скрыт</option>
                            <option value="published">Опубликован</option>
                        </select>
                        @error('visibility') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" wire:click="createAuction">Сохранить</button>
                </div>
            </div>

        </div>

    </div>
    <div class="modal fade" wire:ignore.self id="modal-edit" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Изменение аукциона</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Название</label>
                        <input class="form-control" wire:model="name" type="search" name="adminlteSearch" placeholder="Поиск" aria-label="Поиск">
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Дата закрытия</label>
                        <input class="form-control" wire:model="closing_at" type="datetime-local">
                        @error('closing_at') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Статус</label>
                        <select wire:model="visibility" class="custom-select">
                            <option value="hidden">Скрыт</option>
                            <option value="published">Опубликован</option>
                        </select>
                        @error('visibility') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" wire:click="confirmEdit">Сохранить</button>
                </div>
            </div>

        </div>

    </div>
    <div class="modal fade" wire:ignore.self id="modal-sm" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Удаление аукциона</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить аукцион?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" wire:click="confirmDelete">Удалить</button>
                </div>
            </div>

        </div>

    </div>
</div>
