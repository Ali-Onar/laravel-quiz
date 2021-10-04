<x-app-layout>
    <x-slot name="header">{{ $quiz->title }}</x-slot>
    <div class="card">
        <div class="card-body">
            <p class="card-text">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-group">
                            @if ($quiz->my_rank)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Sıralama
                                    <span class="badge badge-dark badge-pill">#{{ $quiz->my_rank}}</span>
                                </li>
                            @endif
                            @if ($quiz->my_result)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Puan
                                    <span class="badge badge-primary badge-pill">{{ $quiz->my_result->point}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Doğru / Yanlış Sayısı
                                    <div class="float-right">
                                        <span class="badge badge-success badge-pill">{{ $quiz->my_result->correct}}</span>
                                        <span class="badge badge-danger badge-pill">{{ $quiz->my_result->wrong}}</span>
                                    </div>
                                </li>
                            @endif
                                
                            @if ($quiz->finished_at)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Son Katılım Tarihi
                                    <span title="{{$quiz->finished_at}}" class="badge badge-secondary badge-pill">{{ $quiz->finished_at->diffForHumans().' bitecek.' }}</span>
                                </li>
                            @endif

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Soru Sayısı
                                <span class="badge badge-warning badge-pill">{{ $quiz->questions_count }}</span>
                            </li>

                            @if ($quiz->details)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Katılımcı Sayısı
                                    <span class="badge badge-secondary badge-pill">{{ $quiz->details['join_count'] }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Ortalama Puan
                                    <span class="badge badge-light badge-pill">{{ $quiz->details['average'] }}</span>
                                </li>
                            @endif
                            
                        </ul>
                        
                        @if(count($quiz->topTen)>0)
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="card-title">İlk 10</div>
                                    <ul class="list-group">
                                        @foreach ($quiz->topTen as $result)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <strong class="h6">{{ $loop->iteration."." }}</strong>
                                                <img src="{{ $result->user->profile_photo_url }}" class="w-8 rounded-full" alt="{{ $result->user->name }}">
                                                <span @if(auth()->user()->id == $result->user_id) class="text-success" @endif>{{ $result->user->name }}</span>
                                                <span class="badge badge-info badge-pill">{{ $result->point }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="col-md-8">
                         {{ $quiz->description }}</p>
                         @if ($quiz->my_result)
                             <a href="{{ route('quiz.join', $quiz->slug) }}" class="btn btn-primary btn-sm btn-block">Quiz'i Görüntüle</a>
                         @else
                             <a href="{{ route('quiz.join', $quiz->slug) }}" class="btn btn-primary btn-sm btn-block">Quiz'e Katıl</a>
                         @endif
                        
                    </div>
                </div>
               
        </div>
    </div>
</x-app-layout>
