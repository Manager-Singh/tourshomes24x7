@extends('frontend.main')
@section('content')
    <!--Hero section starts-->
    @include('frontend.includes.hero')
    <!--Hero section ends-->
    <!--Popular Cities starts>
    <!--Popular Cities ends>
    <!--Popular Property starts-->
    @include('frontend.includes.popular-properties')
    @include('frontend.includes.popular-city')

    <!--Popular Property ends-->
    @include('frontend.includes.featured-property')
    <!--Featured Property ends-->
    <!--Trending events starts-->
    @include('frontend.includes.recent-properties')
    <!--Trending events ends-->
    <!--Team section starts-->
    @include('frontend.includes.agents')
    <!--Team section ends-->
    <!--News section starts-->
    @include('frontend.includes.news')
    <!--News section ends-->
@endsection
@push('script')
<script>
    $(document).on('change','#state',function(){
        var state = $(this).val();
        $.ajax({
            method:'post',
            url: '{{route('state.city')}}',
            data: {state:state,"_token":"{{csrf_token()}}"},
            dataType:'html',
            success:function(response){
                $('#city').html(response);
                $('#city').selectpicker('refresh');
            }
        });
    });
</script>
@endpush