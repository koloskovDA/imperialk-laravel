<div style="position: absolute; top:5px; right: 20px; font-size: 16pt;">
    <h6 style="margin:0;">Время на сервере</h6>
    <i class="fa fa-clock-o fa-6" style="font-size: 22px;"></i>
    <strong>
        <span wire:poll.keep-alive.1000ms>
            {{now()->format('H:i:s')}}
        </span>
    </strong>
    <h6 style="margin:0;">московского времени</h6>
</div>
