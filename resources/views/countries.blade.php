<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Livewire</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css')}}">
    @livewireStyles
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <h4 class="d-flex justify-content-center mb-3">World Countries</h4>
                @livewire('countries')
            </div>
        </div>
    </div>
    </div>
    <script src="{{asset('jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('sweetalert2/sweetalert2.min.js')}}"></script>
    @livewireScripts
    <script>
        window.addEventListener('OpenModalAddCountry', function() {
            $('.addCountry').find('span').html('')
            $('.addCountry').find('form')[0].reset('')
            $('.addCountry').modal('show');
        })

        window.addEventListener('CloseModalAddCountry', function() {
            $('.addCountry').find('span').html('')
            $('.addCountry').find('form')[0].reset('')
            $('.addCountry').modal('hide');
            alert('Country added successfully')
        })

        window.addEventListener('OpenModalUpdateCountry', function() {
            $('.editCountry').find('span').html('')
            $('.editCountry').modal('show')
        })

        window.addEventListener('CloseModalUpdateCountry', function() {
            $('.editCountry').find('span').html('')
            $('.editCountry').find('form')[0].reset('')
            $('.editCountry').modal('hide');
            alert('Country updated successfully')
        })

        window.addEventListener('SwalConfirm', function(e) {
            swal.fire({
                title: e.detail.title,
                imageWidth: 48,
                imageHeight: 48,
                html: e.detail.html,
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Yes, Delete',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                width: 300,
                allowOutsideClick: false
            }).then(function(result){
                if(result.value){
                    window.livewire.emit('delete', e.detail.id)
                }
            })
        })

        window.addEventListener('deleted', function(){
            alert('deleted successfully')
        })
    </script>
</body>

</html>