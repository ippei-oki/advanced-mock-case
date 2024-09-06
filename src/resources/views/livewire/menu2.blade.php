<div>
    <button class="menu-btn" wire:click="openModal()" type="button" style="height: 30px;">
        <img src="{{asset('storage/icon_menu.png')}}" alt="Button Image" style="height: 100%;">
    </button>
 
    @if($isOpen)
        <div class="modal-window">
            <button class="close-btn" wire:click="closeModal()" type="button" style="height: 30px;">
                    <img src="{{asset('storage/icon_close.png')}}" alt="Button Image" style="height: 100%;">
            </button>
            <div>
                <ul class="menu-list">
                    @if($user)
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <form class="menu-list__logout" action="/logout" method="post">
                                @csrf
                                <button>Logout</button>
                            </form>
                        </li>
                        <li>
                            <a href="/mypage">Mypage</a>
                        </li>
                    @else
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <a href="/register">Registration</a>
                        </li>
                        <li>
                            <a href="/login">Login</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    @endif
</div>