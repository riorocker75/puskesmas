@extends('layouts.main_app')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->



    </div>  
    
    <section class="content">
        @php
            $jlh_pasien= App\Models\Pasien::where('status',1)->count();; 
            $jlh_rekam= App\Models\Rekam::where('status',1)->count();;   
            $jlh_rujuk= App\Models\Rujukan::all()->count();;   

        @endphp
      <div class="container-fluid">
         <div class="row">
                <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$jlh_pasien}}</h3>

                            <p>Pasien</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                        <a href="{{url('/dashboard/pasien/data')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                 </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$jlh_rekam}}</h3>

                            <p>Rekam Medik</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        </div>
                        <a href="{{url('/dashboard/rekam/data')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{$jlh_rujuk}}</h3>

                            <p>Rujukan</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        </div>
                        <a href="{{url('/dashboard/rujuk/data')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
         </div>

         <div class="card">
            <div class="card-header">
              Data Poli terkini
          
            </div>
            <div class="card-body">

              @php
                  $poli = DB::table('rekam')
                 ->select('id_poli', DB::raw('count(*) as total'))
                 ->groupBy('id_poli')
                 ->get();
              @endphp

              @foreach ($poli as $item)
                  
                @php
                    $cek=App\Models\Poli::where('id',$item->id_poli)->get();

                @endphp
                @foreach ($cek as $cp)
                   <p>
                    {{$cp->prosedur}} : {{$item->total}} pasien
                     </p> 
                @endforeach

            
              @endforeach
              {{-- {{$cek->prosedur}} --}}
            </div>
         </div>


      </div>  
      </section>   

</div>  


@endsection