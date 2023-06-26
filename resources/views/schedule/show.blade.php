<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('移動スケジュールの詳細') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="mb-6">
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">運転手</p>
              @if ($schedule->user->nickname === Null)
              <p class="py-2 px-3 text-grey-darkest" id="driver">
                {{$schedule->user->name}}
              </p>
              @else
              <p class="py-2 px-3 text-grey-darkest" id="driver">
                {{$schedule->user->nickname}}
              </p>
              @endif
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">出発地</p>
              <p class="py-2 px-3 text-grey-darkest" id="origin">
                {{$schedule->origin}}
              </p>
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">目的地</p>
              <p class="py-2 px-3 text-grey-darkest" id="destination">
                {{$schedule->destination}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">出発時刻</p>
              <p class="py-2 px-3 text-grey-darkest" id="departure_time">
                {{$schedule->departure_time}}
              </p>
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">到着時刻</p>
              <p class="py-2 px-3 text-grey-darkest" id="arrival_time">
                {{$schedule->arrival_time}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">連絡事項</p>
              <p class="py-2 px-3 text-grey-darkest" id="description">
                {{$schedule->description}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">予約者</p>
              @foreach ($schedule->users()->get() as $user)
                @if ($user->nickname === Null)
                <p class="py-2 px-3 text-grey-darkest" id="reserving_user">
                  {{$user->name}}
                </p>
                @else
                <p class="py-2 px-3 text-grey-darkest" id="reserving_user">
                  {{$user->nickname}}
                </p>
                @endif
              @endforeach
            </div>
            @include('common.errors')
            <!-- reserve 状態で条件分岐 -->
            @if($schedule->users()->where('user_id', Auth::id())->exists())
            <!-- cancel ボタン -->
            <form class="mb-6" action="{{ route('cancel', $schedule) }}" method="POST">
                @csrf
                <div class="flex justify-evenly">
                <a href="{{ url('/schedule') }}" class="block text-center w-5/12 py-3 mt-6 font-medium tracking-widest text-black uppercase bg-gray-100 shadow-sm focus:outline-none hover:bg-gray-200 hover:shadow-none">
                    戻る
                </a>
                <button type="submit" class="w-5/12 py-3 mt-6 font-medium tracking-widest text-white uppercase bg-gray-400 shadow-lg focus:outline-none hover:bg-gray-700 hover:shadow-none">
                    キャンセル
                </button>
                </div>
            </form>
            @else
            <!-- reserve ボタン -->
            <form class="mb-6" action="{{ route('reserve', $schedule) }}" method="POST">
                @csrf
                <div class="flex justify-evenly">
                <a href="{{ url('/schedule') }}" class="block text-center w-5/12 py-3 mt-6 font-medium tracking-widest text-black uppercase bg-gray-100 shadow-sm focus:outline-none hover:bg-gray-200 hover:shadow-none">
                    戻る
                </a>
                <button type="submit" class="w-5/12 py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                    予約する
                </button>
                </div>
            </form>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
