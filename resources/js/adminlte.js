import $ from 'jquery';
import './bootstrap';
import './app';

Livewire.on('close-modal', function() {
    $('.modal').modal('hide');
    $('.modal-backdrop').remove();
});
