@if ($errors->any())
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: '#E02424',
        iconColor: '#F9FAFB',
    })
  
    Toast.fire({
        icon: 'error',
        html: '<div class="font-medium text-gray-50">{{ __('¡Ups! Algo salió mal.') }}</div>',
    })
</script>
@endif