@extends('layouts.visitor.app')

@section('title', __('Name Compatibility') . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('meta.description', __('Name Compatibility') . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('meta.keywords', __('Name Compatibility') . ', ' . (Arr::exists($shared_settings, 'keyword') ? $shared_settings['keyword'] : ''))

@section('og.title', __('Name Compatibility') . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('og.description', __('Name Compatibility') . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('content')
    <section class="bg-light py-0 py-sm-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1> Name Compatibility </h1>
                    <h2> {{ $first }} and {{ $second }} </h2>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-0 py-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow rounded-2 p-0">
                        <div class="card-body p-4">
                            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi dicta perspiciatis
                                repellat tempora tempore. Aliquam cupiditate debitis dolorem eos explicabo in, magnam
                                obcaecati perspiciatis placeat quod similique sint. Natus, unde!
                            </div>
                            <div>Accusantium animi consequatur delectus ducimus odit omnis quia quibusdam saepe sint
                                voluptatibus. Deserunt odio pariatur qui quod rerum ut? Blanditiis esse hic illum iste
                                laboriosam nobis perspiciatis quibusdam sequi, voluptatem.
                            </div>
                            <div>Ad beatae commodi consequatur deleniti dolores ducimus eligendi et fuga fugit ipsum
                                labore magnam mollitia necessitatibus nihil nulla optio placeat provident quaerat,
                                quibusdam quo reiciendis repudiandae saepe tempora! Facilis, iusto!
                            </div>
                            <div>Consequuntur dicta ea fugit nobis officia quidem! Dignissimos eum harum iusto unde?
                                Dignissimos, itaque, quod? Consequatur consequuntur distinctio doloribus dolorum
                                eligendi esse est magnam mollitia quidem? Fugiat ipsa quae veniam.
                            </div>
                            <div>A ab accusantium ad animi consequatur ea eaque enim esse ex excepturi fugiat inventore
                                itaque iusto laboriosam laudantium mollitia necessitatibus officia omnis quidem rem
                                repellat reprehenderit vitae, voluptatem! Officiis, soluta?
                            </div>
                            <div>Amet culpa earum, eligendi est, illum iste, iure iusto magni molestiae non nostrum quae
                                quibusdam quod sequi tenetur! Dolorem fugit labore quod! Animi dolorem eaque eligendi
                                est et, impedit quos!
                            </div>
                            <div>Accusamus aperiam enim explicabo illo iusto libero minus perferendis ut! At aut beatae
                                blanditiis commodi consectetur culpa dolores, ex excepturi hic impedit maiores non
                                placeat porro quod repellat saepe voluptates.
                            </div>
                            <div>Accusamus adipisci aperiam asperiores atque blanditiis cum distinctio eligendi illo
                                iusto libero maxime necessitatibus non obcaecati officia perferendis perspiciatis
                                quaerat quas, qui quisquam quod, quos rem repellat tempora veritatis voluptatum!
                            </div>
                            <div>Dignissimos eius est impedit labore perspiciatis, quasi. Consequuntur perspiciatis
                                praesentium quasi reiciendis rem reprehenderit sequi voluptatem? Architecto at cum
                                dolorum eos est necessitatibus nulla odit, omnis. Laboriosam laudantium numquam quae.
                            </div>
                            <div>A amet aspernatur cumque deserunt dicta distinctio doloribus dolorum eaque harum
                                impedit inventore ipsa iste iure laudantium natus nesciunt, optio porro rem saepe sequi
                                sint tenetur veritatis voluptate! Illo, perspiciatis!
                            </div>
                            <div>Alias amet asperiores at culpa cupiditate dolore dolorem, eligendi et fugiat illum in
                                inventore iusto laborum molestiae natus officia omnis praesentium quae quaerat quas
                                quisquam repellendus sapiente tempore. Delectus, fugit.
                            </div>
                            <div>Dolores est fuga laboriosam modi molestias natus, optio! Aliquam commodi cupiditate
                                debitis delectus doloribus esse excepturi, fuga, minus nam nisi nostrum obcaecati
                                placeat reiciendis repellat suscipit tempore veritatis? Non, rerum!
                            </div>
                            <div>Cupiditate ducimus est excepturi, facilis illo molestias officiis omnis tempore unde.
                                Corporis, cupiditate inventore laborum molestias mollitia nam pariatur porro
                                repudiandae. Amet cumque dicta doloribus eveniet quibusdam quod, sapiente sit!
                            </div>
                            <div>Assumenda blanditiis consequatur, deleniti dicta dignissimos dolorem doloribus eius
                                eligendi et facilis in, laborum, minus natus necessitatibus nihil nulla praesentium quam
                                quidem quis quo recusandae reiciendis rem reprehenderit veritatis voluptatum?
                            </div>
                            <div>Consequatur delectus distinctio facilis hic magni nisi quidem vel! Beatae dolore
                                dolorem eveniet expedita quos tempore ullam voluptatibus! Alias blanditiis consequuntur
                                exercitationem hic itaque perspiciatis possimus quia, ratione repellat suscipit.
                            </div>
                            <div>Commodi distinctio dolor enim et fugiat impedit, magnam maiores nulla odio quaerat sed
                                sequi sint, tempora tenetur, veritatis! Beatae explicabo ipsam magnam maxime minus
                                officia perferendis porro quaerat vero. Quam.
                            </div>
                            <div>Asperiores, consectetur consequuntur hic itaque non officiis omnis qui sint voluptates.
                                Amet, aut cum deserunt ducimus, fuga iusto magni maiores modi molestias necessitatibus
                                nulla optio possimus quisquam vel vitae. Aspernatur?
                            </div>
                            <div>Alias amet debitis earum eligendi expedita id illo ipsa laudantium omnis rerum?
                                Aspernatur dolore doloribus dolorum ea esse, expedita explicabo impedit nemo nesciunt
                                omnis soluta suscipit tempore ut veritatis vitae?
                            </div>
                            <div>At culpa, cum dignissimos eveniet exercitationem ipsa nemo nisi numquam possimus quia,
                                sit suscipit totam voluptates. Corporis dolores illo minus quo ratione? Asperiores eius
                                excepturi omnis quia similique. Amet, nam!
                            </div>
                            <div>A accusamus amet aspernatur deleniti deserunt earum eius eos est, et eum fuga
                                laudantium nam pariatur quasi recusandae sed sint soluta tempore temporibus veritatis!
                                Molestiae sunt ullam veritatis? Facere, nam?
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 pt-5 pt-lg-0">
                    <div class="row mb-5 mb-lg-0">
                        <div class="col-md-6 col-lg-12">
                            <div class="card card-body shadow p-4">
                                <h4 class="mb-3 text-center">
                                    Compatibility
                                </h4>
                                <div class="text-center">
                                    <h2 class="mb-0">
                                        {{ $compatibility }} %
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
