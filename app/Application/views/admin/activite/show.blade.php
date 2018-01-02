@extends(layoutExtend())

@section('title')
    {{ trans('activite.activite') }} {{ trans('home.view') }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('activite.activite') , 'model' => 'activite' , 'action' => trans('home.view')  ])
		<table class="table table-bordered table-responsive table-striped">
			</tr>
				<tr><th>{{ trans("activite.title") }}</th>
				@php $type =  getFileType("title" , $item->title) @endphp
				@if($type == "File")
					<td> <a href="{{ url(env("UPLOAD_PATH")."/".$item->title) }}">{{ $item->title }}</a></td>
				@elseif($type == "Image")
					<td> <img src="{{ url(env("UPLOAD_PATH")."/".$item->title) }}" /></td>
				@else
					<td>{{ nl2br($item->title) }}</td>
				@endif</tr>
				<tr><th>{{ trans("activite.video") }}</th>
				@php $type =  getFileType("video" , $item->video) @endphp
				@if($type == "File")
					<td> <a href="{{ url(env("UPLOAD_PATH")."/".$item->video) }}">{{ $item->video }}</a></td>
				@elseif($type == "Image")
					<td> <img src="{{ url(env("UPLOAD_PATH")."/".$item->video) }}" /></td>
				@else
					<td>{{ nl2br($item->video) }}</td>
				@endif</tr>
			</tr>
		</table>

        @include('admin.activite.buttons.delete' , ['id' => $item->id])
        @include('admin.activite.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection
