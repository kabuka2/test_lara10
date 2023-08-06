@if ($errors->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ $errors->first('error') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
<div>
    ascascascasca
</div>
