@extends('layouts.sidebar')

@extends('layouts.header')
<!-- Aquí puedes agregar tu formulario, tabla u otro contenido -->




@section('content')

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
    @endif


    
    <div class="col-md-12 row ">
        <div class="col-md-4 ">
            <div class="card bg-yellow text-white rounded shadow ml-auto" style="width: 10rem;">
                <div class="card-header bg-red text-center p-1">
                    <h6 class="mb-0">Registrar Vehiculo</h6>
                </div>
                <div class="card-body p-2">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class=" fa-lg mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" color="#000000" fill="none">
                            <circle cx="17" cy="18" r="2" stroke="currentColor" stroke-width="1.5" />
                            <circle cx="7" cy="18" r="2" stroke="currentColor" stroke-width="1.5" />
                            <path d="M5 17.9724C3.90328 17.9178 3.2191 17.7546 2.73223 17.2678C2.24536 16.7809 2.08222 16.0967 2.02755 15M9 18H15M19 17.9724C20.0967 17.9178 20.7809 17.7546 21.2678 17.2678C22 16.5355 22 15.357 22 13V11H17.3C16.5555 11 16.1832 11 15.882 10.9021C15.2731 10.7043 14.7957 10.2269 14.5979 9.61803C14.5 9.31677 14.5 8.94451 14.5 8.2C14.5 7.08323 14.5 6.52485 14.3532 6.07295C14.0564 5.15964 13.3404 4.44358 12.4271 4.14683C11.9752 4 11.4168 4 10.3 4H2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 8H8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 11H6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14.5 6H16.3212C17.7766 6 18.5042 6 19.0964 6.35371C19.6886 6.70742 20.0336 7.34811 20.7236 8.6295L22 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg></i>
                        <button class="btn btn-outline-secondary " type="button" data-toggle="collapse" data-target="#formVehiculo" aria-expanded="false" aria-controls="formVehiculo" style="font-size: 10px">
                            <i class="fas fa-plus"></i> Ver más
                        </button>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2  ">
            <div class="card bg-yellow text-white rounded shadow ml-auto" style="width: 10rem;">
                <div class="card-header bg-red text-center p-1">
                    <h6 class="mb-0">Vehiculos Trans...</h6>
                </div>
                <div class="card-body p-2">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class=" fa-lg mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" color="#000000" fill="none">
                            <path d="M17 20C18.1046 20 19 19.1046 19 18C19 16.8954 18.1046 16 17 16C15.8954 16 15 16.8954 15 18C15 19.1046 15.8954 20 17 20Z" stroke="currentColor" stroke-width="1.5" />
                            <path d="M7 20C8.10457 20 9 19.1046 9 18C9 16.8954 8.10457 16 7 16C5.89543 16 5 16.8954 5 18C5 19.1046 5.89543 20 7 20Z" stroke="currentColor" stroke-width="1.5" />
                            <path d="M19 11H22V13C22 15.357 22 16.5355 21.2678 17.2678C20.7809 17.7546 20.0967 17.9178 19 17.9724M5 17.9724C3.90328 17.9178 3.2191 17.7546 2.73223 17.2678C2 16.5355 2 15.357 2 13V9C2 6.64298 2 5.46447 2.73223 4.73223C3.46447 4 4.64298 4 7 4H10.3C11.4168 4 11.9752 4 12.4271 4.14683C13.3404 4.44358 14.0564 5.15964 14.3532 6.07295C14.5 6.52485 14.5 7.08323 14.5 8.2C14.5 9.42079 14.5 10.0312 14.1657 10.444C14.0998 10.5254 14.0254 10.5998 13.944 10.6657C13.5312 11 12.9208 11 11.7 11H8M15 18H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14.5 6H16.3212C17.7766 6 18.5042 6 19.0964 6.35371C19.6886 6.70742 20.0336 7.34811 20.7236 8.6295L22 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M10 13C10 13 9.3279 12.4436 8.73729 11.9161C8.31975 11.5803 8 11.2926 8 11.0048C8 10.7498 8.24949 10.5128 8.6558 10.1415C9.23188 9.66187 10 9 10 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg></i>
                        <button class="btn btn-outline-secondary " type="button" data-toggle="collapse" data-target="#VehiculoTransportista" aria-expanded="false" aria-controls="formVehiculo" style="font-size: 10px">
                            <i class="fas fa-plus"></i> Ver más
                        </button>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2  ">
            <div class="card bg-yellow text-white rounded shadow ml-auto" style="width: 10rem;">
                <div class="card-header bg-red text-center p-1">
                    <h6 class="mb-0">Dueño Vehiculos</h6>
                </div>
                <div class="card-body p-2">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-tie fa-lg mr-2"></i>
                        <button class="btn btn-outline-secondary " type="button" data-toggle="collapse" data-target="#tablaVehiculos" aria-expanded="false" aria-controls="tablaVehiculos" style="font-size: 10px">
                            <i class="fas fa-plus"></i> Ver más
                        </button>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-2  ">
            <div class="card bg-yellow text-white rounded shadow ml-auto" style="width: 10rem;">
                <div class="card-header bg-red text-center p-1">
                    <h6 class="mb-0">Vehículos</h6>
                </div>
                <div class="card-body p-2">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class=" fa-lg"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" color="#000000" fill="none">
                            <circle cx="17" cy="18" r="2" stroke="currentColor" stroke-width="1.5" />
                            <circle cx="7" cy="18" r="2" stroke="currentColor" stroke-width="1.5" />
                            <path d="M11 17H15M13.5 7H14.4429C15.7533 7 16.4086 7 16.9641 7.31452C17.5196 7.62904 17.89 8.20972 18.6308 9.37107C19.1502 10.1854 19.6955 10.7765 20.4622 11.3024C21.2341 11.8318 21.6012 12.0906 21.8049 12.506C22 12.9038 22 13.375 22 14.3173C22 15.5596 22 16.1808 21.651 16.5755C21.636 16.5925 21.6207 16.609 21.6049 16.625C21.2375 17 20.6594 17 19.503 17H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13 7L13.9942 9.48556C14.4813 10.7034 14.7249 11.3123 15.2328 11.6561C15.7407 12 16.3965 12 17.7081 12H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.86957 17C3.51684 17 2.84048 17 2.42024 16.5607C2 16.1213 2 15.4142 2 14V7C2 5.58579 2 4.87868 2.42024 4.43934C2.84048 4 3.51684 4 4.86957 4H10.1304C11.4832 4 12.1595 4 12.5798 4.43934C13 4.87868 13 5.58579 13 7V17H8.69565" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg></i>
                        <h4 class="ml-2 mb-0">{{ $totalVehiculos }}</h4>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-md-2  ">
            <div class="card bg-yellow text-white rounded shadow ml-auto" style="width: 10rem;">
                <div class="card-header bg-red text-center p-1">
                    <h6 class="mb-0">Vehículos Carreta</h6>
                </div>
                <div class="card-body p-2">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class=" fa-lg "><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" color="#000000" fill="none">
                            <path d="M7 17.5C7 18.8807 5.88071 20 4.5 20C3.11929 20 2 18.8807 2 17.5C2 16.1193 3.11929 15 4.5 15C5.88071 15 7 16.1193 7 17.5Z" stroke="currentColor" stroke-width="1.5" />
                            <path d="M17 17.5C17 18.8807 15.8807 20 14.5 20C13.1193 20 12 18.8807 12 17.5C12 16.1193 13.1193 15 14.5 15C15.8807 15 17 16.1193 17 17.5Z" stroke="currentColor" stroke-width="1.5" />
                            <path d="M20 4V15.0106C20 15.9433 20 16.4097 20.1522 16.7776C20.4767 17.5617 21.1896 17.9585 22 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4 9H5.74643C6.6103 9 7.04224 9 7.43781 9.11037C7.83828 9.22211 8.21115 9.41587 8.53276 9.67935C8.85045 9.93962 9.09871 10.2931 9.59524 11C10.0918 11.7069 10.34 12.0604 10.6577 12.3206C10.9793 12.5841 11.3522 12.7779 11.7527 12.8896C12.1482 13 12.5802 13 13.444 13H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M18 13H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4 15V6C4 4.89543 4.89543 4 6 4H8.89512C9.60829 4 10.2981 4.25406 10.8409 4.71663L14.2972 7.66198C14.7431 8.04197 15 8.59836 15 9.18422V15M7 17.5H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg></i>
                        <h4 class="ml-2 mb-0">{{ $totalVehiculosConCarreta }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <style>
            h4{
                font-size: 12px;
                font-weight: bold;
                height: 30px;
                width: 30px;
                background-color: rgb(55, 0, 255);
                border-radius: 50%;
                color: azure;
                align-items: center;
                align-content: center;
                text-align: center;
                justify-content: center;
                justify-items: center;
            }
        </style>
        
    </div>

    <div class="container mb-3" >
        
        <div class="collapse" id="tablaVehiculos" style="max-height: 300px;overflow-y:auto;scrollbar-width: thin">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Dueño</th>
                        <th>Vehículo</th>
                        <th>Placa Carreta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehiculos->groupBy(function($vehiculo) {
                        return strtolower($vehiculo->dueño);
                    }) as $dueño => $vehiculosDeDueño)
                        @foreach ($vehiculosDeDueño as $index => $vehiculo)
                            <tr>
                                @if ($index === 0)
                                    <td rowspan="{{ $vehiculosDeDueño->count() }}">{{ ucwords($dueño) }}</td>
                                @endif
                                <td>{{ $vehiculo->placa }}</td>
                                <td>{{ $vehiculo->placa1 ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="collapse" id="formVehiculo">
           <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title">Registro de Vehiculos</div>

                </div>
                <div class="card-body">
                    <form action="{{ route('vehiculo.store') }}" method="POST">
                        @csrf <!-- Agrega el token CSRF -->
        
                        <div class="form-group ">
                            <label for="dueño" class="form-control-label">Dueño:</label>
                            <input type="text" name="dueño" class="form-control" id="dueño" placeholder=" " required maxlength="100">
                           
                        </div>
                        <div class="form-group row">
        
                            <div class="col">
                                <label for="placa" class="form-control-label">Placa Principal:</label>
                                <input type="text" name="placa" class="form-control " id="placa" placeholder=" " required maxlength="7" minlength="7">
                                
                            </div>
                            <div class="col">
                                <label for="placa1" class="form-control-label">Placa Carreta:</label>
                                <input type="text" name="placa1" class="form-control " id="placa1" placeholder=" "  maxlength="7" minlength="7">
                                
                            </div>
        
                        </div>
        
                        <div class="form-group row">
                            <div class="col">
                                <label for="codigo" class="form-control-label">Código:</label>
                                <input type="text" name="codigo" class="form-control " id="codigo" placeholder=" " required maxlength="10">
                               
                            </div>
                            <div class="col ">
                                <label for="id_transportista" >Transportista:</label>
        
                                <select name="id_transportista" id="id_transportista" class="form-control" required style="font-size:14px; overflow:auto">
                                    <option value="">Selecionar ID</option>
                                    @foreach($transportistas->reverse() as $transportista)
        
                                        <option value="{{ $transportista->id }}">{{ $transportista->id }}-{{Str::limit($transportista->razon_social),100  }}</option>
                                    @endforeach
                                </select>
                            </div>
        
                        </div>
                       
                        
        
        
        
                        <div class="form-group row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="fas fa-save"></i> Guardar
                                </button>
                                <button type="reset" class="btn btn-secondary mt-3" id="limpiar-btn">
                                    <i class="fas fa-broom"></i> Limpiar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">

                </div>
           </div>
        </div>

       
    </div>
    
    
    
    
    
    
    
   <div class="card collapse" id="vehiculoTransportista">
    <div class="card-header bg-primary">
        <div class="card-title">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" color="#ffffff" fill="none">
                <path d="M19.5 17.5C19.5 18.8807 18.3807 20 17 20C15.6193 20 14.5 18.8807 14.5 17.5C14.5 16.1193 15.6193 15 17 15C18.3807 15 19.5 16.1193 19.5 17.5Z" stroke="currentColor" stroke-width="1.5" />
                <path d="M9.5 17.5C9.5 18.8807 8.38071 20 7 20C5.61929 20 4.5 18.8807 4.5 17.5C4.5 16.1193 5.61929 15 7 15C8.38071 15 9.5 16.1193 9.5 17.5Z" stroke="currentColor" stroke-width="1.5" />
                <path d="M14.5 17.5H9.5M19.5 17.5H20.2632C20.4831 17.5 20.5931 17.5 20.6855 17.4885C21.3669 17.4036 21.9036 16.8669 21.9885 16.1855C22 16.0931 22 15.9831 22 15.7632V13C22 9.41015 19.0899 6.5 15.5 6.5M15 15.5V7C15 5.58579 15 4.87868 14.5607 4.43934C14.1213 4 13.4142 4 12 4H5C3.58579 4 2.87868 4 2.43934 4.43934C2 4.87868 2 5.58579 2 7V15C2 15.9346 2 16.4019 2.20096 16.75C2.33261 16.978 2.52197 17.1674 2.75 17.299C3.09808 17.5 3.56538 17.5 4.5 17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M6.5 7V10.9998M10.5 7V10.9998" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Vehículos por Transportista
        </div>

    </div>
    <div class="card-body" style="max-height:300px;overflow-y:auto,scrollbar-width:thin">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Transportista</th>
                    <th>Vehículos</th>
                </tr>
            </thead>
            <tbody>
                @php $contador = 1; @endphp
                @foreach ($transportistas as $transportista)
                    <tr>
                        <td>{{ $contador }}</td>
                        <td rowspan="{{ count($transportista->vehiculos) }}">{{ $transportista->razon_social }}</td>
                        <td>
                            <ol class="lista-vehiculos">
                                @foreach ($transportista->vehiculos as $vehiculo)
                                    <li>{{ $vehiculo->placa }}</li>
                                @endforeach
                            </ol>
                        </td>
                    </tr>
                    @php $contador += count($transportista->vehiculos); @endphp
                @endforeach
            </tbody>
        </table>
        
    </div>
    <div class="card-footer">

    </div>
   </div>
    
    
   
    
    
           
        

    
    
        
    
    
    
    

    <div class="card ">
        <div class="card-header bg-primary text-white text-center" >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" color="#ffffff" fill="none">
                <path d="M14 14L16.5 16.5" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                <path d="M16.4333 18.5252C15.8556 17.9475 15.8556 17.0109 16.4333 16.4333C17.0109 15.8556 17.9475 15.8556 18.5252 16.4333L21.5667 19.4748C22.1444 20.0525 22.1444 20.9891 21.5667 21.5667C20.9891 22.1444 20.0525 22.1444 19.4748 21.5667L16.4333 18.5252Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                <path d="M16 9C16 5.13401 12.866 2 9 2C5.13401 2 2 5.13401 2 9C2 12.866 5.13401 16 9 16C12.866 16 16 12.866 16 9Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
            </svg>
            <span>Buscar Vehículo</span>
        </div>
        <div class="card-body">
            <form action="{{ route('vehiculo.buscar') }}" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="placa" class="form-label">Placa:</label>
                            <input type="text" class="form-control" id="placa" name="placa">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="placa1" class="form-label">Placa Carreta:</label>
                            <input type="text" class="form-control" id="placa1" name="placa1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="codigo" class="form-label">Código:</label>
                            <input type="text" class="form-control" id="codigo" name="codigo">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="dueño" class="form-label">Dueño:</label>
                            <input type="text" class="form-control" id="dueño" name="dueño">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="id_transportista" class="form-label">Transportista:</label>
                            <!-- Dentro de tu formulario -->
                            <select name="id_transportista" id="id_transportista" class="form-control">
                                <option value="">Seleccionar Transportista</option>
                                @foreach ($transportistas as $transportista)
                                    <option value="{{ $transportista->id }}">{{ Str::limit($transportista->razon_social, 100) }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
                <!-- Agrega más campos de búsqueda si es necesario -->
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
                                <path d="M20.6693 7C20.7527 6.8184 20.7971 6.62572 20.8297 6.37281C21.0319 4.8008 21.133 4.0148 20.672 3.5074C20.2111 3 19.396 3 17.7657 3H6.23433C4.60404 3 3.7889 3 3.32795 3.5074C2.86701 4.0148 2.96811 4.8008 3.17033 6.3728C3.22938 6.8319 3.3276 7.09253 3.62734 7.44867C4.59564 8.59915 6.36901 10.6456 8.85746 12.5061C9.08486 12.6761 9.23409 12.9539 9.25927 13.2614C9.53961 16.6864 9.79643 19.0261 9.93278 20.1778C10.0043 20.782 10.6741 21.2466 11.226 20.8563C12.1532 20.2006 13.8853 19.4657 14.1141 18.2442C14.2223 17.6668 14.3806 16.6588 14.5593 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M17.5 8V15M21 11.5L14 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                             Filtrar
                        </button>
                        <a href="/vehiculos" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
                                <path d="M16.3884 3L17.3913 3.97574C17.8393 4.41165 18.0633 4.62961 17.9844 4.81481C17.9056 5 17.5888 5 16.9552 5H9.19422C5.22096 5 2 8.13401 2 12C2 13.4872 2.47668 14.8662 3.2895 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M7.61156 21L6.60875 20.0243C6.16074 19.5883 5.93673 19.3704 6.01557 19.1852C6.09441 19 6.4112 19 7.04478 19H14.8058C18.779 19 22 15.866 22 12C22 10.5128 21.5233 9.13383 20.7105 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 12H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                             Restablecer
                        </a>
                    </div>
                </div>
            </form>
            
            
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-primary d-flex align-items-center">
              <h5 class="modal-title" id="exampleModalLabel">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#ffffff" fill="none">
                    <path d="M20.002 11V10C20.002 6.22876 20.002 4.34315 18.7615 3.17157C17.521 2 15.5245 2 11.5314 2H10.4726C6.47947 2 4.48293 2 3.24244 3.17157C2.00195 4.34315 2.00195 6.22876 2.00195 10V14C2.00195 17.7712 2.00195 19.6569 3.24244 20.8284C4.48293 22 6.47946 22 10.4726 22H11.002" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M7.00195 7H15.002" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M7.00195 12H15.002" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M20.8624 14.4393L21.5567 15.1317C22.1441 15.7175 22.1441 16.6672 21.5567 17.253L17.9192 20.9487C17.6331 21.234 17.2671 21.4264 16.8693 21.5005L14.6149 21.9885C14.259 22.0656 13.942 21.7504 14.0183 21.3952L14.4981 19.1599C14.5724 18.7632 14.7653 18.3982 15.0515 18.1129L18.7352 14.4393C19.3226 13.8536 20.275 13.8536 20.8624 14.4393Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Agregar Nuevo Registro
                </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Aquí puedes agregar los campos para el nuevo registro -->
              <form action="{{ route('vehiculo.store') }}" method="POST">
                @csrf <!-- Agrega el token CSRF -->

                <div class="form-group ">
                    <input type="text" name="dueño" class="form-control mt-2" id="dueño" placeholder=" " required >
                    <label for="dueño" class="form-control-label">Dueño:</label>
                </div>
                <div class="form-group row">

                    <div class="col">
                        <input type="text" name="placa" class="form-control mt-2" id="placa" placeholder=" " required maxlength="7" minlength="7">
                        <label for="placa" class="form-control-label">Placa Principal:</label>
                    </div>
                    <div class="col">
                        <input type="text" name="placa1" class="form-control mt-2" id="placa1" placeholder=" "  maxlength="7" minlength="7">
                        <label for="placa1" class="form-control-label">Placa Carreta:</label>
                    </div>

                </div>

                <div class="form-group row">
                    <div class="col">
                        <input type="text" name="codigo" class="form-control mt-2" id="codigo" placeholder=" " required maxlength="10">
                        <label for="codigo" class="form-control-label">Código:</label>
                    </div>

                </div>
                <div class="col">

                    <div class="form-group row">
                        <label for="id_transportista" >Transportista:</label>


                        <select name="id_transportista" id="id_transportista" class="form-control mt-2" required style="font-size:14px; overflow:auto">
                            <option value="">Selecionar ID</option>
                            @foreach($transportistas->reverse() as $transportista)

                                <option value="{{ $transportista->id }}">{{ $transportista->id }}-{{Str::limit($transportista->razon_social),100  }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>



                <div class="form-group row">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary mt-3">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                        <button type="reset" class="btn btn-secondary mt-3" id="limpiar-btn">
                            <i class="fas fa-broom"></i> Limpiar
                        </button>
                    </div>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    <div class="card">
        <div class="card-header d-flex w-100">
            <h3 class="card-title">Lista de Vehiculos</h3>
            <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#exampleModal" title="Registrar Vehiculo">
                <i class="fas fa-plus"></i>
            </button>
        </div>

        <div class="card-body p-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Placa</th>
                        <th>Placa Carreta</th>
                        <th>Codigo</th>
                        <th>Dueño</th>
                        <th>ID transportista</th>
                        
                        <th>Acciones</th>
                        
                    </tr>

                </thead>
                <tbody>
                    @foreach ($vehiculos as $vehiculo)
                        <tr>
                            <td>{{ $vehiculo->id }}</td>
                            <td>{{ $vehiculo->placa }}</td>
                            <td>{{ $vehiculo->placa1 }}</td>
                            <td>{{ $vehiculo->codigo }}</td>
                            <td>{{ $vehiculo->dueño }}</td>
                            <td>{{ $vehiculo->id_transportista }}</td>
                            
                            
                            
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $vehiculo->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                      </svg>
                                </button>
                                <div class="modal fade" id="editModal{{ $vehiculo->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $vehiculo->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title" id="editModalLabel{{ $vehiculo->id }}">Editar Conductor</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Formulario para editar la guía de remisión -->
                                                <form id="editForm{{ $vehiculo->id }}" action="{{ route('vehiculo.update', $vehiculo->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- Campos para editar -->
                                                    <div class="form-group row">
                                                        <div class="col-md-6 ">
                                                            <label for="dueño">Dueño:</label>
                                                            <input type="text" class="form-control" id="placa" name="dueño" value="{{ $vehiculo->dueño }}" required>
                                                        </div>

                                                        <div class="col-md-6 ">
                                                            <label for="placa">Placa:</label>
                                                            <input type="text" class="form-control" id="placa" name="placa" value="{{ $vehiculo->placa }}" required>
                                                        </div>

                                                        <div class="d-flex w-100">
                                                            <div class="col-md-6 ">
                                                                <label for="placa">Placa Carreta:</label>
                                                                <input type="text" class="form-control" id="placa1" name="placa1" value="{{ $vehiculo->placa1 }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="codigo">Codigo: </label>
                                                                <input type="text" class="form-control" id="codigo" name="codigo" value="{{ $vehiculo->codigo    }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 w-100">
                                                            <label for="id_transportista">ID Transportista: </label>

                                                            <select class="form-control" id="id_transportista" name="id_transportista" required>
                                                                <option value="" selected disabled >{{$vehiculo->id_transportista}} </option>
                                                                @foreach($vehiculos as $vehiculo)
                                                                    <option value="{{ $vehiculo->id }}" {{ $vehiculo->id_transportista == $vehiculo->id ? 'selected' : '' }}>{{ $vehiculo->transportista->razon_social }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <!-- Agrega aquí más campos para editar -->
                                                    <button type="submit" class="btn btn-primary float-right">Guardar Cambios</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('vehiculo.destroy', $vehiculo->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-filled" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" stroke-width="0" fill="currentColor" />
                                            <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor" />
                                          </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>
        
    </div>
@endsection

@sección('js')

@endsección

@section('css')
<link rel="stylesheet" href="{{ asset('css/styleTables.css') }}">
@endsection