import $ from 'jquery';

Livewire.on('close-modal', function() {
    $('.modal').find('[data-dismiss="modal"]').click();
    $('.modal-backdrop').remove();
});
