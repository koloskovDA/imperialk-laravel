import $ from 'jquery';
import 'bootstrap';

Livewire.on('close-modal', function() {
    $('.modal').modal('hide');
    $('.modal-backdrop').remove();
});
