<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}" />
    <title>kadai-app | フォロー/フォロワーリスト</title>
</head>
<!-- フォロー/フォロワーリスト画面 -->

<body>
    <x-header></x-header>
    <div class="page follow-page">
        <a href="/user/{{ $user->id }}">
            <div class="user">{{ $user->name }}</div>
        </a>
        <div class="tab">
            <div id="follow-tab" class="tab-item follow-tab" onclick="switchTab('follow')">
                フォロー
            </div>
            <div id="follower-tab" class="tab-item follower-tab" onclick="switchTab('follower')">
                フォロワー
            </div>
        </div>
        <div id="follow-list" class="folllow-list user-list">
            @foreach ($followUsers as $followUsers)
            <a href="/user/{{ $followUsers->id }}">
                <div class="user-list-item">
                    <img class="user-icon" src="{{ asset('/img/user_icon.png') }}" alt="" />
                    <div class="info">
                        <div class="user-name">{{ $followUsers->name }}</div>
                        <div class="biography">
                            {{ $followUsers->biography }}
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div id="follower-list" class="folllower-list user-list">
            @foreach ($followerUsers as $followerUsers)
            <a href="/user/{{ $followerUsers->id }}">
                <div class="user-list-item">
                    <img class="user-icon" src="{{ asset('/img/user_icon.png') }}" alt="" />
                    <div class="info">
                        <div class="user-name">
                            {{ $followerUsers->name }}
                        </div>
                        <div class="biography">
                            {{ $followerUsers->biography }}
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <x-footer></x-footer>
</body>
<script src="{{ asset('/js/app.js') }}"></script>
<script>
    // urlの最後を取得(follow of follower)
    let lastUrl = location.href.split("/").pop();
    switchTab(lastUrl);

    function switchTab(selectedTabName) {
        // 一旦両方から選択を外す
        document.getElementById(`follow-tab`).classList.remove("selected");
        document
            .getElementById(`follower-tab`)
            .classList.remove("selected");
        // 一旦両方を選択を隠す
        document.getElementById(`follow-list`).classList.add("hidden");
        document.getElementById(`follower-list`).classList.add("hidden");

        // タブを選択済みにする
        document
            .getElementById(`${selectedTabName}-tab`)
            .classList.add("selected");
        // 選択された方を表示する
        document
            .getElementById(`${selectedTabName}-list`)
            .classList.remove("hidden");
    }
</script>
<style scoped>
    .follow-page .tab {
        display: flex;
        justify-content: space-evenly;
        height: 30px;
    }
    
    .follow-page .tab-item {
        width: 50vw;
        text-align: center;
    }
    
    .follow-page .user-icon {
        width: 35px;
        height: 35px;
        margin-right: 5px;
    }
    
    .follow-page .user {
        font-size: larger;
        font-weight: bolder;
        padding: 5px 0 10px 10px;
    }
    
    .follow-page .user-list-item {
        display: flex;
        padding: 0 0 10px 10px;
    }
    
    .follow-page .user-name {
        font-weight: bold;
    }
    
    .follow-page .biography {
        font-size: small;
    }
    
    .follow-page .hidden {
        display: none;
    }
    
    .follow-page .selected {
        text-decoration: underline overline lightblue;
    }
</style>

</html>