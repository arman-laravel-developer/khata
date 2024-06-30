@extends('front.master')

@section('seo')
    <meta name="language" content="bn" />
    <meta http-equiv="Content-Language" content="bn" />
    <meta name="robots" content="all">
    <meta name="googlebot" content="all" />
    <meta name="googlebot-news" content="all" />
    <meta name="Developer" content="Md Arman Ali" />
    <meta name="Developed By" content="Apcom Group" />
    <meta name="keywords" content="Bangla News, Bangladesh News, Bengali News, Bangla NewsPaper, Bangladesh Newspaper, Paper, Bengali NewsPaper, Indian Newspaper, Online Bangla News, bd newspaper, news paper, bangla news paper, bangladeshi newspaper, news paper bangladesh, daily news paper in bangladesh, daily newspapers of bangladesh, daily newspaper, daily newspaper, current news, current news, bengali daily newspaper, daily news,portal, portal, bangla, bangla, news, news, bangladesh, bangladesh, bangladeshi, bangladeshi, bengali, culture, portal site, dhaka, textile, garments, micro credit,dhaka news, world news, national news, bangladesh media, betar, current news,sports, bangladesh sports, bangladesh, bangladesh politics, bangladesh business, banglanews, bangla khobor, bangla potrika, bangla, bengali, dhaka, news, reviews, opinion and feature stories. Bangla News Network provides trusted Bangladeshi and International news as well as local and regional perspectives. Find also entertainment, business, science, technology, sports, movies, travel, jobs, education, health, environment, human-rights news and more,বিডি প্রতিদিন, বাংলা নিউজ নেটওয়ার্ক খেলার খবর, বিডি প্রতিদিন খবর, প্রতিদিন বাংলাদেশ, বিডি প্রতিদিন অনলাইন, বিডি প্রতিদিন ক্রিকেট, বাংলা নিউজ নেটওয়ার্ক পত্রিকা, বাংলা নিউজ নেটওয়ার্ক অনলাইন, বাংলা নিউজ নেটওয়ার্ক আন্তর্জাতিক, বাংলা নিউজ নেটওয়ার্ক খেলার খবর, বাংলা নিউজ নেটওয়ার্ক চাকরির খবর, বাংলা নিউজ নেটওয়ার্ক শিক্ষা খবর, বাংলা নিউজ আজকের, বাংলা নিউজ পেপার, প্রতিদিনের সংবাদ, বাংলাদেশের সর্বশেষ সংবাদ, প্রতিবেদন, বিশ্লেষণ, খেলা, বিনোদন, চাকরি, রাজনীতি, বাণিজ্য, বিজ্ঞান, প্রযুক্তি ও শিল্প সংবাদ পড়তে এখানে ভিজিট করুন। বাংলাদেশ ও বিশ্বের সর্বশেষ নিউজ পেতে আমাদের ওয়েবসাইট দেখুন।, সরকার, রাজনীতি, নীতিমালা, বাংলাদেশ, সংবিধান, নির্বাচন, মন্ত্রিপরিষদ, প্রধানমন্ত্রী, সংসদ, পার্টি, রাজধানী, প্রেসিডেন্ট, সরকারী নীতি" />
    <meta name="description" content="বাংলাদেশের সর্বশেষ সংবাদ, প্রতিবেদন, বিশ্লেষণ, খেলা, বিনোদন, চাকরি, রাজনীতি, বাণিজ্য, বিজ্ঞান, প্রযুক্তি ও শিল্প সংবাদ পড়তে এখানে ভিজিট করুন। বাংলাদেশ ও বিশ্বের সর্বশেষ নিউজ পেতে আমাদের ওয়েবসাইট দেখুন।">
    <meta name="author" content="Bangla News Network" />
    <meta name="url" content="https://www.banglann.com.bd" />
@endsection

@section('title')
    ত্রুটি | {{env('APP_NAME')}}
@endsection

@section('content')
    <section class="author-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h4 class="text-uppercase text-danger mt-3"><img src="{{asset('/')}}front/assets/public/templateimage/error.png"style="width: 45%" alt=""></h4>
                                <p class="text-muted mt-3">দুঃখিত, এই পৃষ্ঠাটি বর্তমানে অনুপস্থিত।</p>
                            </div>
                        </div> <!-- end card-body-->
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="sitebar-fixd" style="position: sticky; top: 0;"><!-- Fixd Siteber -->
                        <div class="archivePopular">
                            <ul class="nav nav-pills" id="archivePopular-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <div class="nav-link active" data-bs-toggle="pill" data-bs-target="#archiveTab_recent" role="tab" aria-controls="archiveRecent" aria-selected="false"> সর্বশেষ সংবাদ </div>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <div class="nav-link" data-bs-toggle="pill" data-bs-target="#archiveTab_popular" role="tab" aria-controls="archivePopulars" aria-selected="false"> আলোচিত সংবাদ </div>
                                </li>
                            </ul>
                        </div>
                        @php
                            $recent_news = \App\Models\News::where('status', 1)->latest()->take(20)->get();
                            $popular_news = \App\Models\News::where('status', 1)->orderBy('view_count', 'desc')->take(20)->get();
                        @endphp
                        <div class="tab-content" id="pills-tabContentarchive">
                            <div class="tab-pane active show  fade" id="archiveTab_recent" role="tabpanel" aria-labelledby="archiveRecent">
                                <div class="archiveTab-sibearNews">
                                    @foreach($recent_news as $recent_news_single)
                                        <div class="archive-tabWrpp archiveTab-border">
                                            <div class="archiveTab-image ">
                                                <img class="lazyload" src="{{asset('/')}}front/assets/public/templateimage/63c56e51a22c9.jpg" data-src="{{asset($recent_news_single->image)}}" alt="{{$recent_news_single->news_title}}" title="{{$recent_news_single->news_title}}">
                                            </div>
                                            <h4 class="archiveTab_hadding">
                                                <a href="{{route('news.details', ['id' => $recent_news_single->id, 'slug' => $recent_news_single->slug])}}"> {{$recent_news_single->news_title}} </a>
                                            </h4>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <div class="tab-pane fade" id="archiveTab_popular" role="tabpanel" aria-labelledby="archivePopulars">
                                <div class="archiveTab-sibearNews">
                                    @foreach($popular_news as $popular_news_single)
                                        <div class="archive-tabWrpp archiveTab-border">
                                            <div class="archiveTab-image ">
                                                <img class="lazyload" src="{{asset('/')}}front/assets/public/templateimage/63c56e51a22c9.jpg" data-src="{{asset($popular_news_single->image)}}" alt="{{$popular_news_single->news_title}}" title="{{$popular_news_single->news_title}}">
                                            </div>
                                            <h4 class="archiveTab_hadding">
                                                <a href="{{route('news.details', ['id' => $popular_news_single->id, 'slug' => $popular_news_single->slug])}}"> {{$popular_news_single->news_title}} </a>
                                            </h4>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="siteber-add2">
                            <a href="https://banglann.com.bd" target="_blank"><img src="{{asset('/')}}front/assets/public/templateimage/63ad66eeaa3fc.gif" alt="Bangla News Network"></a>
                        </div>
                    </div> <!-- Fixd Siteber End -->

                </div>
            </div>
        </div>
    </section>
@endsection

