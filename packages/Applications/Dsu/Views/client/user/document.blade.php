@extends("SystemView::client.client")
@section('content')
<div class="client content">
<div class="container">
	
	<div class="row">
      
      <!-- edit form column -->
      <div class="col-lg-10 col-lg-offset-1 personal-info">
        <form action="{{route('dsu.client.user.document')}}" method="POST" role="form" enctype="multipart/form-data">
				{{csrf_field()}}

		<legend>Upload your documents</legend>
		<h6 class="text-info text-justify">If you don't have document or does not applicable to your course, you need not to upload it.</h6>
		<hr />
		<p>Please upload to update the latest copy of the document</p>
		@foreach($documents as $document)
					<div class="form-group">
					<label for="">{{ $document->title }}</label>
					<p class="text-muted{{$user->setuser()->userDocuments()->hasDocument($document->slug) ? ' text-success' :' text-warning'}}">You have {{$user->setuser()->userDocuments()->hasDocument($document->slug) ? "":"not"}} uploaded this document</p>
					@if ($errors->has('document.'.$document->slug))
                    <span class="{{ $errors->has('document.'.$document->slug) ? ' text-danger has-error' : '' }}">
                        <strong>{{ $errors->first('document.'.$document->slug) }}</strong>
                    </span>
          @endif
					<input type="file" name="document[{{$document->slug}}]" class="form-control" id="" placeholder="Input field">
				</div>
				@endforeach
        
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-primary" value="Save Changes">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
</div>
@stop