{{-- @extends('beautymail::templates.widgets')

@section('content')

	@include('beautymail::templates.widgets.articleStart')

		<h4 class="secondary"><strong>Hello World</strong></h4>
		<p>This is a test</p>

	@include('beautymail::templates.widgets.articleEnd')


	@include('beautymail::templates.widgets.newfeatureStart')

		<h4 class="secondary"><strong>Hello World again</strong></h4>
		<p>This is another test</p>

	@include('beautymail::templates.widgets.newfeatureEnd')

@stop --}}


@extends('beautymail::templates.widgets')

@section('content')

    @include('beautymail::templates.widgets.articleStart')

        <div class="text-center">
		<h4 class="secondary">
		<strong>
		Hi {{ ucfirst($user->fname) }},</strong></h4>
		{{-- Hi Pj Abing,</strong></h4> --}}
		<br/>
		<br/>  
		
		<p>
		Below is your Registration Code
	    </p> 
	    <p>
		<h1>{{ $user->confirmation_code }}</h1>
	    </p>
		
		<br/>
		<p>
		Thanks,
		</p>

		<p>
		E-Pawn | Team Revil
        </p>
        </div>

	
	@include('beautymail::templates.widgets.articleEnd')

@stop
