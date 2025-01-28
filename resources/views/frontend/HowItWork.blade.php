@extends('frontend.partial.master')

@section('page-css')
    <style>
        @media (max-width: 575px) {
            .learn-more-watch-text {
                font-size: 35px !important;
                line-height: 35px;
            }
        }
    </style>

@endsection

@section('content')
    <div class="">
        <div class="container custom-box-head">
            <div class="desktop-view">
                <div class="row">
                    <div class="col-3">
                        <div class="section-nav left-side" id="menu-section-scroll">
                            <ol>
                                <li class="sign-up-text">
                                    <a class="signmain-menu" href="#step1-create-domain"><span>1 </span> Sign Up
                                        <ul class="create-your-domain-text">
                                            <li><a href="#step1-create-domain">
                                                    <p></p>Create your domain
                                                </a></li>
                                            <li><a href="#step2-opt-ingbgc">
                                                    <p></p>Opt in to content
                                                </a></li>
                                        </ul>
                                    </a>
                                </li>
                                <li class="sign-up-text"> <a class="signmain-menu" href="#step3-invitepeople"><span>2
                                        </span>Invite People</a></li>
                                <li class="sign-up-text"><a class="signmain-menu" href="#step4-build-scratch"><span>3
                                        </span>Create Training</a>
                                    <ul class="create-your-domain-text">
                                        <li><a href="#step4-build-scratch">
                                                <p></p>Build from scratch
                                            </a></li>
                                        <li><a href="#step5-use-prebuilt-content">
                                                <p></p>Use prebuilt content
                                            </a></li>
                                        <li><a href="#step6-importparty-training">
                                                <p></p>Import third-party training
                                            </a></li>
                                    </ul>
                                </li>
                                <li class="sign-up-text"><a class="signmain-menu" href="#step7-publish-training"><span>4
                                        </span>Publish & Enroll</a></li>
                                <li class="sign-up-text"><a class="signmain-menu" href="#step8-discover-learn"><span>5
                                        </span>Discover & Learn</a></li>
                                <li class="sign-up-text"><a class="signmain-menu" href="#step9-analyze-impact"><span>6
                                        </span>Analyze</a></li>
                                <li class="sign-up-text"><a class="signmain-menu" href="#step10-integrations"><span>7
                                        </span>Integrations</a></li>
                            </ol>
                        </div>


                    </div>
                    <div class="col-9">
                        <div class="right">

                            <img src="{{ asset('frontend/img/badal-img-2.svg') }}" class="badalimg-scrollsection"
                                alt="">
                            <div id="step1-create-domain" class="right-child-item">
                                <div class="create-domain-box">
                                    <div class="create-domain-box-item-1">
                                        <svg viewBox="0 0 57 57">
                                            <g fill="none">
                                                <path fill="#198FD9"
                                                    d="M19.7 27.6h16.5c2.6 0 4.7 2.1 4.7 4.7S38.8 37 36.2 37H19.7c-2.6 0-4.7-2.1-4.7-4.7s2.1-4.7 4.7-4.7z">
                                                </path>
                                                <path fill="#8C8D8E" d="M27.5 34.6v13.3h5.4z" opacity="0.45"></path>
                                                <path fill="#383632"
                                                    d="M55.2 49.1H1.9c-.6 0-1.1-.5-1.1-1.1V9c0-.6.5-1.1 1.1-1.1.6 0 1.1.5 1.1 1.1v37.9h51v-38c0-.6.5-1.1 1.1-1.1.6 0 1.1.5 1.1 1.1v39c.1.7-.4 1.2-1 1.2z">
                                                </path>
                                                <path fill="#FFF"
                                                    d="M49.6 41l-20.2-7c-.6-.2-1.2.4-1 1l7.1 20.2c.2.6 1.1.7 1.4.1l2.4-5c.2-.5.9-.6 1.2-.2l4.4 4.4c.3.3.8.3 1.1 0l2.8-2.8c.3-.3.3-.8 0-1.1l-4.4-4.4c-.4-.4-.3-1 .2-1.2l5-2.4c.7-.4.7-1.3 0-1.6z">
                                                </path>
                                                <path fill="#383632"
                                                    d="M51.3 41.7c0-.8-.5-1.4-1.3-1.7l-20.2-7.1c-.7-.2-1.4-.1-2 .5-.5.5-.7 1.3-.4 2l7.1 20.2c.3.7.9 1.2 1.7 1.3h.1c.7 0 1.4-.4 1.7-1.1l2.2-4.6 4.1 4.1c.7.7 1.9.7 2.7 0l2.8-2.8c.4-.4.6-.8.6-1.3s-.2-1-.6-1.3l-4.1-4.1 4.6-2.2c.6-.5 1-1.2 1-1.9zm-7.1 2.2c-.5.3-.9.8-1 1.4-.1.6.1 1.2.5 1.7l4.2 4.2-2.3 2.3-4.2-4.2c-.4-.4-1.1-.6-1.7-.5-.6.1-1.1.5-1.4 1l-2 4.2-6.6-18.7 18.7 6.6-4.2 2z">
                                                </path>
                                                <path fill="#BFBFBF"
                                                    d="M43.8 17.5H12c-1.7 0-3 1.4-3 3 0 1.7 1.4 3 3 3h31.9c1.7 0 3-1.4 3-3s-1.4-3-3.1-3zM53.7.2H3.4C2 .2.8 1.3.8 2.8V9h55.4V2.8c.1-1.5-1.1-2.6-2.5-2.6z">
                                                </path>
                                                <g fill="#FFF" transform="translate(5 3)">
                                                    <circle cx="1.8" cy="2.1" r="1.2"></circle>
                                                    <circle cx="5.5" cy="2.1" r="1.2"></circle>
                                                    <circle cx="9.2" cy="2.1" r="1.2"></circle>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="create-domain-box-item-2">
                                        <h4>Create your domain</h4>
                                        <p>Claim your .rise domain to get started. For example, if you work at Glivy, set up
                                            your Rise account as glivy.rise.com</p>
                                    </div>
                                </div>

                                <img src="{{ asset('frontend/img/create-domain-img.png') }}"
                                    class="img-fluid  create-domain-img" alt="">
                            </div>
                            <div id="step2-opt-ingbgc" class="right-child-item">
                                <div class="create-domain-box">
                                    <div class="create-domain-box-item-1">
                                        <svg fill="none" viewBox="0 0 76 54">
                                            <path fill="#198FD9" d="M24.443 37.479h-8.63v7.15h8.63v-7.15z"></path>
                                            <path fill="#BFBFBF"
                                                d="M36.023 37.479h-8.63v7.15h8.63v-7.15zm11.57 0h-8.63v7.15h8.63v-7.15z"></path>
                                            <path fill="#198FD9"
                                                d="M59.173 37.479h-8.63v7.15h8.63v-7.15zm-34.73-19h-8.63v7.15h8.63v-7.15z">
                                            </path>
                                            <path fill="#BFBFBF"
                                                d="M24.443 27.759h-8.63v7.15h8.63v-7.15zm11.58-9.28h-8.63v7.15h8.63v-7.15zm0 9.28h-8.63v7.15h8.63v-7.15zm11.57-9.28h-8.63v7.15h8.63v-7.15z">
                                            </path>
                                            <path fill="#198FD9" d="M47.593 27.759h-8.63v7.15h8.63v-7.15z"></path>
                                            <path fill="#BFBFBF" d="M59.173 18.479h-8.63v7.15h8.63v-7.15z"></path>
                                            <path fill="#8D8D8E" d="M59.173 27.759h-8.63v7.15h8.63v-7.15z" opacity="0.45">
                                            </path>
                                            <path fill="#393633"
                                                d="M10.953 48.659v-5.92c0-4.24.033-8.487.1-12.74v-15.51c0 .32 0-.08.1-.19a.6.6 0 01.5-.27c.61-.06 1.25 0 1.86 0h17.27c7.333 0 14.666-.034 22-.1l6.31-.08 3.29-.05a3.25 3.25 0 011.13 0 .72.72 0 01.3.32 6.575 6.575 0 010 1.83v28.61a22.636 22.636 0 00.09 3.19v.32c0 .11.1.67 0 .1v.06a1.13 1.13 0 002.25 0v.1c.03-.142.05-.286.06-.43.077-.56.113-1.125.11-1.69v-31.85a3.13 3.13 0 00-.78-2.11 3.39 3.39 0 00-2.74-1.05l-3.31.06c-8 .12-15.967.186-23.9.2h-22.61a8.743 8.743 0 00-2.17.12 3.069 3.069 0 00-2 1.67 6.5 6.5 0 00-.29 2.78v10.21c0 4.46.08 8.92.11 13.38v8.99a1.13 1.13 0 002.25 0l.07.05z">
                                            </path>
                                            <path fill="#393633"
                                                d="M5.163 53.629l1.4.18-.52-.16a2.6 2.6 0 001.39.21h62.72a5.32 5.32 0 004.37-3.17c.33-.74 1-1.7.47-2.48a1.33 1.33 0 00-1.15-.6H1.513a1.34 1.34 0 00-1.25 1 2.09 2.09 0 00.31 1.39 7.629 7.629 0 001.24 2.16 4.94 4.94 0 003.49 1.84c1.44.06 1.44-2.19 0-2.25a3.2 3.2 0 01-2.29-1.73 7.637 7.637 0 01-.35-.83c-.08-.17-.15-.34-.22-.51-.07-.17-.08-.37 0-.07l-.12.87.06-.1-.68.52c-.16.06-.24 0-.06 0h72.16c.19 0 .09.06-.07 0l-.67-.52v.1l-.11-.87c.07-.31 0 0 0 .07s-.14.33-.22.49c-.102.279-.22.553-.35.82a3.22 3.22 0 01-2.23 1.66h-56.09a54.566 54.566 0 00-8.77.26h-.12a.88.88 0 00-.01 1.72z">
                                            </path>
                                            <path fill="#198FD9"
                                                d="M64 22.009c6.075 0 11-4.925 11-11 0-6.076-4.925-11-11-11-6.076 0-11 4.924-11 11 0 6.075 4.924 11 11 11z">
                                            </path>
                                            <path fill="#fff"
                                                d="M58.444 8.954l-2.056 2.055 6.19 6.19 2.056-2.056-6.19-6.19z"></path>
                                            <path fill="#fff"
                                                d="M60.545 15.136l2.056 2.055 9.04-9.04-2.056-2.055-9.04 9.04z"></path>
                                        </svg>
                                    </div>
                                    <div class="create-domain-box-item-2">
                                        <h4>Opt in to the GBGC course catalog</h4>
                                        <p>Grant learners access to the complete Rise course catalog—including hundreds of
                                            professionally developed courses—instantly.</p>
                                    </div>
                                </div>
                                <img src="{{ asset('frontend/img/opt-inthegbgc.png') }}" class="img-fluid create-domain-img"
                                    alt="">
                            </div>
                            <div id="step3-invitepeople" class="right-child-item">
                                <div class="create-domain-box">
                                    <div class="create-domain-box-item-1">
                                        <svg viewBox="0 0 60 53">
                                            <g fill="none">
                                                <g transform="translate(4 5)">
                                                    <path fill="#8D8E8E"
                                                        d="M31.4 28.6c0 4.7-4.1 6.1-9.2 6.1S13 33.4 13 28.6c0-4.7 4.1-13.5 9.2-13.5s9.2 8.7 9.2 13.5z">
                                                    </path>
                                                    <circle cx="22.3" cy="9.1" r="8.2" fill="#BFBFBF"></circle>
                                                    <path fill="#BFBFBF"
                                                        d="M14.1 8.4s-1.6-4.2-5.4-3.7c-3.8.6-4.2 8.3-7.8 8.8 0 .1 9.1 8 13.2-5.1z">
                                                    </path>
                                                </g>
                                                <path fill="#383632"
                                                    d="M49.3 45.2h-48c-.6 0-1.1-.5-1.1-1.1V1.5C.2.9.7.4 1.3.4h48c.6 0 1.1.5 1.1 1.1v42.6c.1.6-.4 1.1-1.1 1.1zM2.4 43h45.8V2.6H2.4V43z">
                                                </path>
                                                <circle cx="44.3" cy="37.6" r="14.8" fill="#198FD9"></circle>
                                                <path fill="#FFF" d="M53 35.6h-6.6V29h-4v6.6h-6.6v4h6.6v6.6h4v-6.6H53z">
                                                </path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="create-domain-box-item-2">
                                        <h4>Invite people to GBGC</h4>
                                        <p>Add admins, content creators, reporters, and learners, then set their permissions.
                                            You can do this step at any time.</p>
                                    </div>
                                </div>

                                <img src="{{ asset('frontend/img/invite-people-img.jpg') }}"
                                    class="img-fluid create-domain-img" alt="">
                            </div>
                            <div id="step4-build-scratch" class="right-child-item">
                                <div class="create-domain-box">
                                    <div class="create-domain-box-item-1">
                                        <svg viewBox="0 0 71 48">
                                            <g fill="none">
                                                <path fill="#BFBFBF"
                                                    d="M50.3 19c-7.7 0-14.3 4.4-17.6 10.7-1.6-1-3.6-1.6-5.6-1.6-5.9 0-10.7 4.8-10.7 10.7h53.8c-.1-10.9-9-19.8-19.9-19.8z">
                                                </path>
                                                <path fill="#383632"
                                                    d="M59.4 41.4c-.6 0-1.1.5-1.1 1.1v2.9h-2.9c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h4c.6 0 1.1-.5 1.1-1.1v-4c.1-.5-.4-1.1-1.1-1.1zm-30.3 4h-8.8c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h8.8c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1zm17.6 0h-8.8c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h8.8c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1zm-35.2 0H8.6v-2.9c0-.6-.5-1.1-1.1-1.1-.6 0-1.1.5-1.1 1.1v4c0 .6.5 1.1 1.1 1.1h4c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1zm-4-8.2c.6 0 1.1-.5 1.1-1.1v-6.5c0-.6-.5-1.1-1.1-1.1-.6 0-1.1.5-1.1 1.1v6.5c0 .6.5 1.1 1.1 1.1zm0-13c.6 0 1.1-.5 1.1-1.1v-6.5c0-.6-.5-1.1-1.1-1.1-.6 0-1.1.5-1.1 1.1v6.5c0 .6.5 1.1 1.1 1.1zm4-19.1h-4c-.6 0-1.1.5-1.1 1.1v4c0 .6.5 1.1 1.1 1.1.6 0 1.1-.5 1.1-1.1V7.3h2.9c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1zm35.2 0h-8.8c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h8.8c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1zm-17.6 0h-8.8c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h8.8c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1zm30.3 0h-4c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h2.9v2.9c0 .6.5 1.1 1.1 1.1.6 0 1.1-.5 1.1-1.1v-4c.1-.6-.4-1.1-1.1-1.1zm0 23.4c-.6 0-1.1.5-1.1 1.1v6.5c0 .6.5 1.1 1.1 1.1.6 0 1.1-.5 1.1-1.1v-6.5c.1-.6-.4-1.1-1.1-1.1zm0-13c-.6 0-1.1.5-1.1 1.1v6.5c0 .6.5 1.1 1.1 1.1.6 0 1.1-.5 1.1-1.1v-6.5c.1-.6-.4-1.1-1.1-1.1z">
                                                </path>
                                                <circle cx="13.1" cy="13.4" r="13" fill="#198FD9"></circle>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="create-domain-box-item-2">
                                        <h4>Build from scratch</h4>
                                        <p>Create unique lessons by stacking modular media, text, and interactive blocks in any
                                            order you want. Then customize them with your own content.</p>
                                    </div>
                                </div>
                                <video class="create-domain-img"
                                    src="https://riseusercontent.com/assets/rise/assets/marketing-animations/build-from-scratch.mp4"
                                    preload="auto" loop="" playsinline="" webkit-playsinline="" x5-playsinline=""
                                    style="width: 100%; height: 100%;" autoplay=""></video>
                            </div>
                            <div id="step5-use-prebuilt-content" class="right-child-item">
                                <div class="create-domain-box">
                                    <div class="create-domain-box-item-1">
                                        <svg viewBox="0 0 67 63">
                                            <defs>
                                                <path id="howitworks-3_2_svg__a" d="M0 62.484h66.104V0H0z"></path>
                                            </defs>
                                            <g fill="none" fill-rule="evenodd">
                                                <path fill="silver"
                                                    d="M2.773 31.84c0 .621.504 1.125 1.125 1.125h7.7a1.125 1.125 0 000-2.25h-7.7c-.62 0-1.125.504-1.125 1.125m15.4 0c0 .621.504 1.125 1.125 1.125h7.7a1.125 1.125 0 000-2.25h-7.7c-.62 0-1.125.504-1.125 1.125m15.401 0c0 .621.504 1.125 1.125 1.125h7.699a1.125 1.125 0 000-2.25h-7.7c-.62 0-1.124.504-1.124 1.125M1.125 12.639c.621 0 1.125-.503 1.125-1.125v-1.377h4.073a1.125 1.125 0 000-2.25H1.125A1.124 1.124 0 000 9.011v2.502c0 .622.504 1.125 1.125 1.125m0 15.4c.621 0 1.125-.504 1.125-1.125v-7.7a1.125 1.125 0 00-2.25 0v7.7c0 .621.504 1.125 1.125 1.125m56.673-2.328c-.62 0-1.125.504-1.125 1.125v3.88h-6.575a1.125 1.125 0 000 2.25h7.7c.621 0 1.125-.504 1.125-1.125v-5.005c0-.62-.504-1.125-1.125-1.125">
                                                </path>
                                                <mask id="howitworks-3_2_svg__b" fill="#fff">
                                                    <use xlink:href="#howitworks-3_2_svg__a"></use>
                                                </mask>
                                                <path fill="#393633"
                                                    d="M2.25 60.234h54.423v-20.58H2.25v20.58zm55.548-22.83H1.125A1.128 1.128 0 000 38.53v22.829c0 .62.504 1.125 1.125 1.125h56.673c.621 0 1.125-.504 1.125-1.125v-22.83c0-.62-.504-1.124-1.125-1.124z"
                                                    mask="url(#howitworks-3_2_svg__b)"></path>
                                                <path fill="#393633"
                                                    d="M28.218 48.245h21.217a1.125 1.125 0 000-2.25H28.218a1.125 1.125 0 100 2.25m0 6.004h13.783a1.125 1.125 0 100-2.25H28.218a1.125 1.125 0 100 2.25"
                                                    mask="url(#howitworks-3_2_svg__b)"></path>
                                                <path fill="#FFF" d="M9.305 23.954h55.674V1.124H9.305z"
                                                    mask="url(#howitworks-3_2_svg__b)"></path>
                                                <path stroke="#393633" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2.25" d="M9.305 23.954h55.674V1.124H9.305z"
                                                    mask="url(#howitworks-3_2_svg__b)"></path>
                                                <path fill="#198FD9" d="M44.31 12.54l-10.967 6.275V6.263z"
                                                    mask="url(#howitworks-3_2_svg__b)"></path>
                                                <path fill="silver"
                                                    d="M14.6 43.649a6.295 6.295 0 100 12.59 6.295 6.295 0 006.295-6.295H14.6v-6.295z"
                                                    mask="url(#howitworks-3_2_svg__b)"></path>
                                                <path fill="#198FD9"
                                                    d="M15.916 42.333a6.295 6.295 0 016.296 6.295h-6.296v-6.295z"
                                                    mask="url(#howitworks-3_2_svg__b)"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="create-domain-box-item-2">
                                        <h4>Use prebuilt content</h4>
                                        <p>Start from a template, tweak our sample courses, or choose from hundreds of
                                            ready-to-go, customizable lessons on practical business topics.</p>
                                    </div>
                                </div>
                                <video class="create-domain-img"
                                    src="https://riseusercontent.com/assets/rise/assets/marketing-animations/prebuilt-content.mp4"
                                    preload="auto" loop="" playsinline="" webkit-playsinline="" x5-playsinline=""
                                    style="width: 100%; height: 100%;" autoplay=""></video>
                            </div>
                            <div id="step6-importparty-training" class="right-child-item">
                                <div class="create-domain-box">
                                    <div class="create-domain-box-item-1">
                                        <svg viewBox="0 0 67 63">
                                            <path fill="#C1C0C0"
                                                d="M64 21.5h-3.7c-.6 0-1.2.5-1.2 1.2s.5 1.2 1.2 1.2h2.5v2c0 .6.5 1.2 1.2 1.2.6 0 1.2-.5 1.2-1.2v-3.2c0-.7-.5-1.2-1.2-1.2zm0 20.3c-.6 0-1.2.5-1.2 1.2v5.7c0 .6.5 1.2 1.2 1.2.6 0 1.2-.5 1.2-1.2V43c0-.7-.5-1.2-1.2-1.2zm0-11.5c-.6 0-1.2.5-1.2 1.2v5.7c0 .6.5 1.2 1.2 1.2.6 0 1.2-.5 1.2-1.2v-5.7c0-.6-.5-1.2-1.2-1.2zm0 22.9c-.6 0-1.2.5-1.2 1.2v2h-2c-.6 0-1.2.5-1.2 1.2 0 .6.5 1.2 1.2 1.2H64c.6 0 1.2-.5 1.2-1.2v-3.2c0-.7-.5-1.2-1.2-1.2zm-31 3.1h-5.6c-.6 0-1.2.5-1.2 1.2 0 .6.5 1.2 1.2 1.2H33c.7 0 1.2-.5 1.2-1.2-.1-.6-.6-1.2-1.2-1.2zm22.3 0h-5.6c-.6 0-1.2.5-1.2 1.2 0 .6.5 1.2 1.2 1.2h5.6c.6 0 1.2-.5 1.2-1.2-.1-.6-.6-1.2-1.2-1.2zm-11.1 0h-5.6c-.6 0-1.2.5-1.2 1.2 0 .6.5 1.2 1.2 1.2h5.6c.6 0 1.2-.5 1.2-1.2-.1-.6-.6-1.2-1.2-1.2zm-22.3 0h-2v-2c0-.6-.5-1.2-1.2-1.2-.6 0-1.2.5-1.2 1.2v3.2c0 .6.5 1.2 1.2 1.2h3.2c.6 0 1.2-.5 1.2-1.2-.1-.6-.6-1.2-1.2-1.2z">
                                            </path>
                                            <path fill="C1C0C0"
                                                d="M18.7 50.5c.6 0 1.2-.5 1.2-1.2v-3.2c0-.6-.5-1.2-1.2-1.2-.6 0-1.2.5-1.2 1.2v3.2c.1.7.6 1.2 1.2 1.2z">
                                            </path>
                                            <g fill="#333">
                                                <path
                                                    d="M56.1 7.5H31.5l-7.1-5.7c-.2-.2-.4-.3-.7-.3H8c-.7 0-1.2.5-1.2 1.2v4.9H2.7c-.7-.1-1.2.5-1.2 1.1v37c0 .6.5 1.2 1.2 1.2h53.4c.6 0 1.2-.5 1.2-1.2v-37c0-.6-.6-1.2-1.2-1.2zm-1.3 37h-51V9.9H8c.6 0 1.2-.5 1.2-1.2V3.8h14.1l7.1 5.7c.2.2.4.3.7.3h23.7v34.7z">
                                                </path>
                                                <path
                                                    d="M20.4 27.8c-.2-.1-.4-.2-.6-.2-.2 0-.4 0-.6.2-.1.2-.2.4-.2.6 0 .2.1.4.2.6.2.1.4.2.6.2.2 0 .4 0 .6-.2.2-.2.3-.4.3-.6 0-.2-.1-.5-.3-.6zm1.3-4.4v1h3l-3.1 4.7h5v-.9h-3.1l3.1-4.8zm6.2 0H29v5.7h-1.1zm.5-3.1c-.2 0-.4.1-.6.3-.1.2-.2.4-.2.6 0 .3.1.5.2.6.2.1.4.2.6.2.2 0 .4 0 .6-.2.2-.2.3-.4.3-.6 0-.2-.1-.4-.3-.6-.2-.2-.4-.3-.6-.3zm3.6 2.9h-1.1v8.9H32V28c.2.3.5.6.8.8.3.2.7.3 1.2.3.4 0 .8 0 1.2-.2.4-.1.7-.3 1-.6.3-.3.5-.5.6-1 .1-.4.2-.7.2-1.2 0-.4-.1-.8-.2-1.2-.2-.3-.4-.6-.6-1-.3-.2-.6-.4-1-.6-.3-.1-.7-.2-1.2-.2-.4 0-.8.1-1.2.3-.4.2-.6.5-.8.8v-1zm.1 2.3c.1-.2.2-.4.4-.6.2-.2.4-.3.6-.4.3-.1.5-.2.8-.2.3 0 .5 0 .7.2.3.1.4.2.6.4.2.2.3.4.4.6.1.2.1.4.1.7 0 .2 0 .5-.1.7-.1.2-.2.4-.4.6-.2.2-.4.3-.6.4-.2.1-.4.2-.7.2-.3 0-.6-.1-.8-.2-.2-.1-.4-.2-.6-.4-.2-.2-.3-.4-.4-.6-.1-.1-.1-.3-.1-.6 0-.2 0-.5.1-.8z">
                                                </path>
                                            </g>
                                            <circle cx="43.5" cy="43.8" r="7.4" fill="#198FD9"></circle>
                                            <path fill="#FFF" d="M42.491 46.601l4.172-4.171 1.414 1.414-4.172 4.172z">
                                            </path>
                                            <path fill="#FFF" d="M42.484 40.985l1.415-1.414 4.171 4.172-1.414 1.414z">
                                            </path>
                                            <path fill="#FFF" d="M39.8 42.8h5.9v2h-5.9z"></path>
                                        </svg>
                                    </div>
                                    <div class="create-domain-box-item-2">
                                        <h4>Import third-party training</h4>
                                        <p>If you’d like to manage, distribute, and track all of your training in one system,
                                            you can upload other SCORM content into Rise as well.</p>
                                    </div>
                                </div>
                                <video class="create-domain-img"
                                    src="https://riseusercontent.com/assets/rise/assets/marketing-animations/import-third-party-content.mp4"
                                    preload="auto" loop="" playsinline="" webkit-playsinline="" x5-playsinline=""
                                    autoplay="" style="width: 100%; height: 100%;"></video>
                            </div>
                            <div id="step7-publish-training" class="right-child-item">
                                <div class="create-domain-box">
                                    <div class="create-domain-box-item-1">
                                        <svg viewBox="0 0 58 53">
                                            <g fill="none">
                                                <path fill="#383632"
                                                    d="M49.3 45.8h-48c-.6 0-1.1-.5-1.1-1.1V1.3C.2.7.7.2 1.3.2h48c.6 0 1.1.5 1.1 1.1v43.4c0 .6-.5 1.1-1.1 1.1zM2.4 43.6h45.8V2.4H2.4v41.2z">
                                                </path>
                                                <path fill="#8D8E8E"
                                                    d="M33.7 15.1h8.9c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1h-8.9c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1zm9.6 16H8.7c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h34.6c.6 0 1.1-.5 1.1-1.1 0-.6-.4-1.1-1.1-1.1z">
                                                </path>
                                                <path fill="#BFBFBF"
                                                    d="M8 6.9h21.1v19.7H8zM33.7 9h8.9c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1h-8.9c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1zm0 12.2h8.9c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1h-8.9c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1zm9.6 15.9H8.7c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h34.6c.6 0 1.1-.5 1.1-1.1 0-.6-.4-1.1-1.1-1.1z">
                                                </path>
                                                <circle cx="42.5" cy="37.3" r="15" fill="#198FD9"></circle>
                                                <path fill="#FFF"
                                                    d="M46.1 34.5l-5.6-5.6-2.8 2.8 5.6 5.6-5.6 5.6 2.8 2.8 8.4-8.4z"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="create-domain-box-item-2">
                                        <h4>Publish training and enroll learners</h4>
                                        <p>Publish the training to your library, tag with a category, and enroll individuals or
                                            groups as learners. You can also choose to let learners self‑enroll.</p>
                                    </div>
                                </div>

                                <img src="{{ asset('frontend/img/publish-training-img.png') }}"
                                    class="img-fluid create-domain-img" alt="">
                            </div>
                            <div id="step8-discover-learn" class="right-child-item">
                                <div class="create-domain-box">
                                    <div class="create-domain-box-item-1">
                                        <svg viewBox="0 0 64 59">
                                            <g fill="none">
                                                <path fill="#BFBFBF"
                                                    d="M14.8 9.9c0-3-2.4-5.4-5.4-5.4-3 0-5.4 2.4-5.4 5.4m53.6 41c0-6.8-5.6-12.4-12.4-12.4-6.8 0-12.4 5.6-12.4 12.4">
                                                </path>
                                                <path fill="#383632"
                                                    d="M29.4.3C13.3.3.1 13.4.1 29.6c0 16.2 13.1 29.3 29.3 29.3 16.1 0 29.3-13.1 29.3-29.3C58.7 13.4 45.6.3 29.4.3zM2.5 30.7h11.3c.1 4.5 1.1 8.7 2.7 12.7H6.2C4 39.7 2.7 35.3 2.5 30.7zm28.1-17.2V3.7c3.4 2.8 6.2 6.1 8.3 9.8h-8.3zm9.4 2.3c1.8 3.9 2.8 8.2 2.9 12.7H30.6V15.8H40zm-11.7-2.3H20c2.1-3.7 4.8-7.1 8.3-9.8v9.8zm0 2.3v12.7H16c.1-4.5 1.1-8.8 2.9-12.7h9.4zM13.7 28.5H2.5c.2-4.6 1.5-8.9 3.8-12.7h10.2c-1.7 3.9-2.6 8.2-2.8 12.7zm2.3 2.2h12.3v12.7h-9.4c-1.8-3.9-2.8-8.2-2.9-12.7zm12.3 15v9.8c-3.4-2.8-6.2-6.1-8.3-9.8h8.3zm2.3 0h8.3c-2.1 3.7-4.8 7.1-8.3 9.8v-9.8zm0-2.3V30.7h12.3c-.1 4.5-1.1 8.8-2.9 12.7h-9.4zm14.5-12.7h11.3c-.2 4.6-1.5 8.9-3.8 12.7H42.4c1.7-3.9 2.6-8.2 2.7-12.7zm0-2.2C45 24 44 19.8 42.4 15.8h10.2c2.2 3.7 3.6 8.1 3.8 12.7H45.1zm6-15h-9.8c-2-4-4.9-7.7-8.4-10.7 7.5 1 14 5 18.2 10.7zM25.9 2.8c-3.5 3-6.4 6.7-8.4 10.7H7.7C12 7.8 18.5 3.8 25.9 2.8zM7.7 45.7h9.8c2 4 4.9 7.7 8.4 10.7-7.4-1-13.9-5-18.2-10.7zM33 56.4c3.5-3 6.4-6.7 8.4-10.7h9.8c-4.3 5.7-10.8 9.7-18.2 10.7z">
                                                </path>
                                                <circle cx="51.2" cy="13.6" r="12.5" fill="#198FD9"></circle>
                                                <path fill="#BFBFBF"
                                                    d="M22.9 10.6c-7.1 0-12.9 5.8-12.9 12.9 0 7.1 12.9 20.1 12.9 20.1s12.9-13 12.9-20.1c0-7.1-5.8-12.9-12.9-12.9zm0 15.7c-2.5 0-4.6-2-4.6-4.6 0-2.5 2-4.6 4.6-4.6 2.6 0 4.6 2 4.6 4.6 0 2.6-2.1 4.6-4.6 4.6z">
                                                </path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="create-domain-box-item-2">
                                        <h4>Discover and learn</h4>
                                        <p>Learners take courses, view scores, and download completion certificates. And they
                                            discover new training material by browsing your library by category.</p>
                                    </div>
                                </div>

                                <img src="{{ asset('frontend/img/discover-learn-img.png') }}"
                                    class="img-fluid create-domain-img" alt="">
                            </div>
                            <div id="step9-analyze-impact" class="right-child-item">
                                <div class="create-domain-box">
                                    <div class="create-domain-box-item-1">
                                        <svg viewBox="0 0 63 51">
                                            <g fill="none">
                                                <path fill="#198FD9"
                                                    d="M44.5 33.4l-2.5 5-5.6.9 6.4 8.8c1.6 2.2 4.7 2.7 7 1.1 2.2-1.6 2.7-4.7 1.1-7l-6.4-8.8zm-32.3-9.8L1.1 34.7c-.4.4-.4 1.2 0 1.6.2.2.5.3.8.3.3 0 .6-.1.8-.3l10.2-10.2c.4-.4.4-1.2 0-1.6-.4-.4-.3-1.3-.7-.9zM59 4.2c-.4-.5-1.1-.5-1.6-.1L46.3 14.4c-.5.4.3 1 .7 1.5.2.3-.3.5 0 .5.2 0 .5-.1.7-.3L58.9 5.8c.5-.4.5-1.1.1-1.6zM43.6 19.6l-8.3 8.1-11.1-10.9-8.1 8.3 1.6 1.6 6.5-6.7 11.1 10.8 9.9-9.6z">
                                                </path>
                                                <path fill="#8C8D8E" d="M48.9 39.5l-4.3-6-3.3 4.3-4.9 1.5 1.2 1.6z"
                                                    opacity="0.45"></path>
                                                <path fill="#BFBFBF"
                                                    d="M9.9.5c-3 0-5.4 2.4-5.4 5.4h10.8c0-3-2.4-5.4-5.4-5.4zm48.2 23.3c-2.5 0-4.5 2-4.5 4.5h9c0-2.5-2-4.5-4.5-4.5zM20.6 44.3c-1 0-2 .6-2.5 1.4-.7-3.1-3.4-5.4-6.7-5.4-3.8 0-6.9 3.1-6.9 6.9h19c0-1.6-1.3-2.9-2.9-2.9z">
                                                </path>
                                                <path fill="#383632"
                                                    d="M30.6 37.8c-4.7 0-9.3-2.2-12.3-6.3-4.9-6.8-3.4-16.3 3.4-21.1C25 8 29 7.1 33 7.7c4 .6 7.5 2.8 9.9 6.1 4.9 6.8 3.4 16.3-3.4 21.1-2.7 2-5.8 2.9-8.9 2.9zm-10.5-7.6c4.2 5.8 12.2 7.1 18 2.9 5.8-4.2 7.1-12.2 2.9-18-2-2.8-5-4.6-8.4-5.2-3.4-.5-6.8.3-9.6 2.3-5.7 4.2-7 12.2-2.9 18z">
                                                </path>
                                                <g fill="#383632">
                                                    <path
                                                        d="M46.4 11.2c-3.1-4.2-7.6-7-12.7-7.8-5.1-.9-10.3.4-14.5 3.4-8.7 6.3-10.7 18.5-4.4 27.2 3.8 5.3 9.8 8.1 15.8 8.1 4 0 7.9-1.2 11.4-3.7 4.2-3.1 7-7.6 7.8-12.7.9-5.1-.4-10.3-3.4-14.5zm1.1 14.2c-.7 4.5-3.2 8.5-6.9 11.2-7.7 5.5-18.4 3.8-24-3.9-5.5-7.7-3.8-18.4 3.9-24 3.7-2.7 8.3-3.7 12.8-3 4.5.7 8.5 3.2 11.2 6.9 2.7 3.7 3.7 8.3 3 12.8z">
                                                    </path>
                                                    <path
                                                        d="M33 7.7c-4-.6-8 .3-11.3 2.7-6.8 4.8-8.3 14.3-3.4 21.1 3 4.1 7.6 6.3 12.3 6.3 3.1 0 6.2-.9 8.9-2.9 6.8-4.8 8.3-14.3 3.4-21.1-2.4-3.3-5.9-5.5-9.9-6.1zm5.1 25.4c-5.8 4.2-13.8 2.9-18-2.9-4.1-5.8-2.8-13.8 2.9-18 2.8-2 6.2-2.8 9.6-2.3 3.4.6 6.4 2.4 8.4 5.2 4.2 5.8 2.9 13.8-2.9 18z">
                                                    </path>
                                                </g>
                                                <path fill="#198FD9"
                                                    d="M58.9 10.5c-.6 0-1.1-.5-1.1-1.1V5.1h-4.3c-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1h5.4c.6 0 1.1.5 1.1 1.1v5.4c0 .6-.5 1.1-1.1 1.1z">
                                                </path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="create-domain-box-item-2">
                                        <h4>Analyze the impact</h4>
                                        <p>See what training materials learners have accessed, the time they’ve spent learning,
                                            and the lessons they’ve completed. Drill into any content to view enrollees, learner
                                            progress, question level reporting, quiz scores, and more.</p>
                                    </div>
                                </div>
                                <img src="{{ asset('frontend/img/img/analyze-img.png') }}" class="img-fluid create-domain-img"
                                    alt="">
                            </div>
                            <div id="step10-integrations" class="right-child-item">
                                <div class="create-domain-box">
                                    <div class="create-domain-box-item-1">
                                        <svg fill="none" viewBox="0 0 72 57">
                                            <clipPath id="howitworks-7_svg__a">
                                                <path d="M0 0h72v57H0z"></path>
                                            </clipPath>
                                            <g clip-path="url(#howitworks-7_svg__a)">
                                                <path fill="#bfbfbf"
                                                    d="M46.51 54.517c-2.714-.62-4.904-2.748-5.517-5.496-3.329.09-6.657-.354-9.81-.088-.614 2.748-2.803 4.964-5.519 5.585-.963.177-1.664 1.063-1.664 2.127V57h24.175v-.355c0-.975-.7-1.862-1.664-2.128z">
                                                </path>
                                                <path fill="#8d8d8e"
                                                    d="M43.007 52.567a7.96 7.96 0 01-2.014-3.546c-3.329.09-6.658-.354-9.81-.088a6.304 6.304 0 01-.964 2.216z"
                                                    opacity="0.45"></path>
                                                <path stroke="#393633" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-miterlimit="10" stroke-width="2.25"
                                                    d="M12.768 48.783h46.336v-30.14H12.768z"></path>
                                                <path stroke="#bfbfbf" stroke-miterlimit="10" stroke-width="2"
                                                    d="M10.686 32.8l24.963 7.535 25.665-7.092M35.65 40.334V16.577"></path>
                                                <path fill="#198FD9"
                                                    d="M36 24c5.523 0 10-4.477 10-10S41.523 4 36 4 26 8.477 26 14s4.477 10 10 10zM10.5 41c4.142 0 7.5-3.582 7.5-8s-3.358-8-7.5-8C6.358 25 3 28.582 3 33s3.358 8 7.5 8zm51 0c4.142 0 7.5-3.582 7.5-8s-3.358-8-7.5-8-7.5 3.582-7.5 8 3.358 8 7.5 8zm-25.85 3.324c2.177 0 3.941-1.786 3.941-3.99s-1.765-3.988-3.941-3.988-3.942 1.786-3.942 3.989 1.765 3.989 3.942 3.989z">
                                                </path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="create-domain-box-item-2">
                                        <h4>Integrations</h4>
                                        <p>See what training materials learners have accessed, the time they’ve spent learning,
                                            and the lessons they’ve completed. Drill into any content to view enrollees, learner
                                            progress, question level reporting, quiz scores, and more.</p>
                                    </div>
                                </div>

                                <img src="{{ asset('frontend/img/integrations-img.png') }}"
                                    class="img-fluid create-domain-img" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mobile-view">
                <div class="section-stick">
                    <div class="sign-upposi header-color">
                        <div class="msign-up-text">
                            <a class="msignmain-menu step-1mosignmenu" href="#step1-mcreate-domain"><span class="mobile-number-bg">1 </span> Sign Up <span class="mobile-iconhit"><i class="fa-solid fa-chevron-up"></i></span></a>
                            <div class="mo-hit-menuclick">
                                <a class="msignmain-menu step-1mosignmenu mobile-active" href="#step1-mcreate-domain"><span class="mobile-number-bg">1 </span> Sign Up </a>
                                <a class="msignmain-menu" href="#step3-minvitepeople"><span class="mobile-number-bg">2</span> Invite People </a>
                                <a class="msignmain-menu" href="#step4-mbuild-scratch"><span class="mobile-number-bg">3</span> Create Training </a>
                                <a class="msignmain-menu" href="#step7-mpublish-training"><span class="mobile-number-bg">4</span> Publish & Enroll </a>
                                <a class="msignmain-menu" href="#step8-mdiscover-learn"><span class="mobile-number-bg">5</span> Train </a>
                                <a class="msignmain-menu" href="#step9-manalyze-impact"><span class="mobile-number-bg">6</span> Analyze </a>
                                <a class="msignmain-menu" href="#step10-mintegrations"><span class="mobile-number-bg">7</span> Integrations </a>
                            </div>
                        </div>
                    </div>
                    <div id="step1-mcreate-domain">
                        <div class="create-domain-box">
                            <div class="create-domain-box-item-1">
                                <svg viewBox="0 0 57 57">
                                    <g fill="none">
                                        <path fill="#198FD9" d="M19.7 27.6h16.5c2.6 0 4.7 2.1 4.7 4.7S38.8 37 36.2 37H19.7c-2.6 0-4.7-2.1-4.7-4.7s2.1-4.7 4.7-4.7z"></path>
                                        <path fill="#8C8D8E" d="M27.5 34.6v13.3h5.4z" opacity="0.45"></path>
                                        <path fill="#383632" d="M55.2 49.1H1.9c-.6 0-1.1-.5-1.1-1.1V9c0-.6.5-1.1 1.1-1.1.6 0 1.1.5 1.1 1.1v37.9h51v-38c0-.6.5-1.1 1.1-1.1.6 0 1.1.5 1.1 1.1v39c.1.7-.4 1.2-1 1.2z"></path>
                                        <path fill="#FFF" d="M49.6 41l-20.2-7c-.6-.2-1.2.4-1 1l7.1 20.2c.2.6 1.1.7 1.4.1l2.4-5c.2-.5.9-.6 1.2-.2l4.4 4.4c.3.3.8.3 1.1 0l2.8-2.8c.3-.3.3-.8 0-1.1l-4.4-4.4c-.4-.4-.3-1 .2-1.2l5-2.4c.7-.4.7-1.3 0-1.6z"></path>
                                        <path fill="#383632" d="M51.3 41.7c0-.8-.5-1.4-1.3-1.7l-20.2-7.1c-.7-.2-1.4-.1-2 .5-.5.5-.7 1.3-.4 2l7.1 20.2c.3.7.9 1.2 1.7 1.3h.1c.7 0 1.4-.4 1.7-1.1l2.2-4.6 4.1 4.1c.7.7 1.9.7 2.7 0l2.8-2.8c.4-.4.6-.8.6-1.3s-.2-1-.6-1.3l-4.1-4.1 4.6-2.2c.6-.5 1-1.2 1-1.9zm-7.1 2.2c-.5.3-.9.8-1 1.4-.1.6.1 1.2.5 1.7l4.2 4.2-2.3 2.3-4.2-4.2c-.4-.4-1.1-.6-1.7-.5-.6.1-1.1.5-1.4 1l-2 4.2-6.6-18.7 18.7 6.6-4.2 2z"></path>
                                        <path fill="#BFBFBF" d="M43.8 17.5H12c-1.7 0-3 1.4-3 3 0 1.7 1.4 3 3 3h31.9c1.7 0 3-1.4 3-3s-1.4-3-3.1-3zM53.7.2H3.4C2 .2.8 1.3.8 2.8V9h55.4V2.8c.1-1.5-1.1-2.6-2.5-2.6z"></path>
                                        <g fill="#FFF" transform="translate(5 3)">
                                            <circle cx="1.8" cy="2.1" r="1.2"></circle>
                                            <circle cx="5.5" cy="2.1" r="1.2"></circle>
                                            <circle cx="9.2" cy="2.1" r="1.2"></circle>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="create-domain-box-item-2">
                                <h4>Create your domain</h4>
                                <p>Claim your .rise domain to get started. For example, if you work at Glivy, set up your Rise account as glivy.rise.com</p>
                            </div>
                        </div>  
                        <img src="{{ asset('frontend/img/create-domain-img.png') }}" class="img-fluid  create-domain-img" alt="">  
                    </div>
                    <div id="step2-opt-ingbgc">
                        <div class="create-domain-box">
                            <div class="create-domain-box-item-1">
                                <svg fill="none" viewBox="0 0 76 54">
                                    <path fill="#198FD9" d="M24.443 37.479h-8.63v7.15h8.63v-7.15z"></path>
                                    <path fill="#BFBFBF" d="M36.023 37.479h-8.63v7.15h8.63v-7.15zm11.57 0h-8.63v7.15h8.63v-7.15z"></path>
                                    <path fill="#198FD9" d="M59.173 37.479h-8.63v7.15h8.63v-7.15zm-34.73-19h-8.63v7.15h8.63v-7.15z"></path>
                                    <path fill="#BFBFBF" d="M24.443 27.759h-8.63v7.15h8.63v-7.15zm11.58-9.28h-8.63v7.15h8.63v-7.15zm0 9.28h-8.63v7.15h8.63v-7.15zm11.57-9.28h-8.63v7.15h8.63v-7.15z"></path>
                                    <path fill="#198FD9" d="M47.593 27.759h-8.63v7.15h8.63v-7.15z"></path>
                                    <path fill="#BFBFBF" d="M59.173 18.479h-8.63v7.15h8.63v-7.15z"></path>
                                    <path fill="#8D8D8E" d="M59.173 27.759h-8.63v7.15h8.63v-7.15z" opacity="0.45"></path>
                                    <path fill="#393633" d="M10.953 48.659v-5.92c0-4.24.033-8.487.1-12.74v-15.51c0 .32 0-.08.1-.19a.6.6 0 01.5-.27c.61-.06 1.25 0 1.86 0h17.27c7.333 0 14.666-.034 22-.1l6.31-.08 3.29-.05a3.25 3.25 0 011.13 0 .72.72 0 01.3.32 6.575 6.575 0 010 1.83v28.61a22.636 22.636 0 00.09 3.19v.32c0 .11.1.67 0 .1v.06a1.13 1.13 0 002.25 0v.1c.03-.142.05-.286.06-.43.077-.56.113-1.125.11-1.69v-31.85a3.13 3.13 0 00-.78-2.11 3.39 3.39 0 00-2.74-1.05l-3.31.06c-8 .12-15.967.186-23.9.2h-22.61a8.743 8.743 0 00-2.17.12 3.069 3.069 0 00-2 1.67 6.5 6.5 0 00-.29 2.78v10.21c0 4.46.08 8.92.11 13.38v8.99a1.13 1.13 0 002.25 0l.07.05z"></path>
                                    <path fill="#393633" d="M5.163 53.629l1.4.18-.52-.16a2.6 2.6 0 001.39.21h62.72a5.32 5.32 0 004.37-3.17c.33-.74 1-1.7.47-2.48a1.33 1.33 0 00-1.15-.6H1.513a1.34 1.34 0 00-1.25 1 2.09 2.09 0 00.31 1.39 7.629 7.629 0 001.24 2.16 4.94 4.94 0 003.49 1.84c1.44.06 1.44-2.19 0-2.25a3.2 3.2 0 01-2.29-1.73 7.637 7.637 0 01-.35-.83c-.08-.17-.15-.34-.22-.51-.07-.17-.08-.37 0-.07l-.12.87.06-.1-.68.52c-.16.06-.24 0-.06 0h72.16c.19 0 .09.06-.07 0l-.67-.52v.1l-.11-.87c.07-.31 0 0 0 .07s-.14.33-.22.49c-.102.279-.22.553-.35.82a3.22 3.22 0 01-2.23 1.66h-56.09a54.566 54.566 0 00-8.77.26h-.12a.88.88 0 00-.01 1.72z"></path>
                                    <path fill="#198FD9" d="M64 22.009c6.075 0 11-4.925 11-11 0-6.076-4.925-11-11-11-6.076 0-11 4.924-11 11 0 6.075 4.924 11 11 11z"></path>
                                    <path fill="#fff" d="M58.444 8.954l-2.056 2.055 6.19 6.19 2.056-2.056-6.19-6.19z"></path>
                                    <path fill="#fff" d="M60.545 15.136l2.056 2.055 9.04-9.04-2.056-2.055-9.04 9.04z"></path>
                                </svg>
                            </div>
                            <div class="create-domain-box-item-2">
                                <h4>Opt in to the GBGC course catalog</h4>
                                <p>Grant learners access to the complete Rise course catalog—including hundreds of professionally developed courses—instantly.</p>
                            </div>
                        </div>  
                        <img src="{{ asset('frontend/img/opt-inthegbgc.png') }}" class="img-fluid create-domain-img" alt="">  
                    </div>
                </div>  
                <div class="section-stick">
                    <div class="sign-upposi header-color">
                        <div class="msign-up-text">
                            <a class="msignmain-menu" href="#step3-minvitepeople"><span class="mobile-number-bg">2</span> Invite People <span class="mobile-iconhit"><i class="fa-solid fa-chevron-up"></i></span></a>
                            <div class="mo-hit-menuclick">
                                <a class="msignmain-menu step-1mosignmenu" href="#step1-mcreate-domain"><span class="mobile-number-bg">1 </span> Sign Up </a>
                                <a class="msignmain-menu mobile-active" href="#step3-minvitepeople"><span class="mobile-number-bg">2</span> Invite People </a>
                                <a class="msignmain-menu" href="#step4-mbuild-scratch"><span class="mobile-number-bg">3</span> Create Training </a>
                                <a class="msignmain-menu" href="#step7-mpublish-training"><span class="mobile-number-bg">4</span> Publish & Enroll </a>
                                <a class="msignmain-menu" href="#step8-mdiscover-learn"><span class="mobile-number-bg">5</span> Train </a>
                                <a class="msignmain-menu" href="#step9-manalyze-impact"><span class="mobile-number-bg">6</span> Analyze </a>
                                <a class="msignmain-menu" href="#step10-mintegrations"><span class="mobile-number-bg">7</span> Integrations </a>
                            </div>
                        </div>
                    </div>
                    <div id="step3-minvitepeople">
                        <div class="create-domain-box">
                            <div class="create-domain-box-item-1">
                                <svg viewBox="0 0 60 53">
                                    <g fill="none"><g transform="translate(4 5)">
                                        <path fill="#8D8E8E" d="M31.4 28.6c0 4.7-4.1 6.1-9.2 6.1S13 33.4 13 28.6c0-4.7 4.1-13.5 9.2-13.5s9.2 8.7 9.2 13.5z"></path>
                                        <circle cx="22.3" cy="9.1" r="8.2" fill="#BFBFBF"></circle>
                                        <path fill="#BFBFBF" d="M14.1 8.4s-1.6-4.2-5.4-3.7c-3.8.6-4.2 8.3-7.8 8.8 0 .1 9.1 8 13.2-5.1z"></path>
                                    </g>
                                        <path fill="#383632" d="M49.3 45.2h-48c-.6 0-1.1-.5-1.1-1.1V1.5C.2.9.7.4 1.3.4h48c.6 0 1.1.5 1.1 1.1v42.6c.1.6-.4 1.1-1.1 1.1zM2.4 43h45.8V2.6H2.4V43z"></path>
                                        <circle cx="44.3" cy="37.6" r="14.8" fill="#198FD9"></circle>
                                        <path fill="#FFF" d="M53 35.6h-6.6V29h-4v6.6h-6.6v4h6.6v6.6h4v-6.6H53z"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="create-domain-box-item-2">
                                <h4>Invite people to GBGC</h4>
                                <p>Add admins, content creators, reporters, and learners, then set their permissions. You can do this step at any time.</p>
                            </div>
                        </div>  
                        <img src=" {{ asset('frontend/img/invite-people-img.jpg')}}" class="img-fluid create-domain-img" alt="">  
                    </div>
                </div> 
                <div class="section-stick">
                    <div class="sign-upposi header-color">
                        <div class="msign-up-text">
                            <a class="msignmain-menu" href="#step4-mbuild-scratch"><span class="mobile-number-bg">3</span> Create Training <span class="mobile-iconhit"><i class="fa-solid fa-chevron-up"></i></span></a>
                            <div class="mo-hit-menuclick">
                                <a class="msignmain-menu step-1mosignmenu" href="#step1-mcreate-domain"><span class="mobile-number-bg">1 </span> Sign Up </a>
                                <a class="msignmain-menu" href="#step3-minvitepeople"><span class="mobile-number-bg">2</span> Invite People </a>
                                <a class="msignmain-menu mobile-active" href="#step4-mbuild-scratch"><span class="mobile-number-bg">3</span> Create Training </a>
                                <a class="msignmain-menu" href="#step7-mpublish-training"><span class="mobile-number-bg">4</span> Publish & Enroll </a>
                                <a class="msignmain-menu" href="#step8-mdiscover-learn"><span class="mobile-number-bg">5</span> Train </a>
                                <a class="msignmain-menu" href="#step9-manalyze-impact"><span class="mobile-number-bg">6</span> Analyze </a>
                                <a class="msignmain-menu" href="#step10-mintegrations"><span class="mobile-number-bg">7</span> Integrations </a>
                            </div>
                        </div>
                    </div>
                    <div id="step4-mbuild-scratch">
                        <div class="create-domain-box">
                            <div class="create-domain-box-item-1">
                                <svg viewBox="0 0 71 48">
                                    <g fill="none">
                                        <path fill="#BFBFBF" d="M50.3 19c-7.7 0-14.3 4.4-17.6 10.7-1.6-1-3.6-1.6-5.6-1.6-5.9 0-10.7 4.8-10.7 10.7h53.8c-.1-10.9-9-19.8-19.9-19.8z"></path>
                                        <path fill="#383632" d="M59.4 41.4c-.6 0-1.1.5-1.1 1.1v2.9h-2.9c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h4c.6 0 1.1-.5 1.1-1.1v-4c.1-.5-.4-1.1-1.1-1.1zm-30.3 4h-8.8c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h8.8c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1zm17.6 0h-8.8c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h8.8c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1zm-35.2 0H8.6v-2.9c0-.6-.5-1.1-1.1-1.1-.6 0-1.1.5-1.1 1.1v4c0 .6.5 1.1 1.1 1.1h4c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1zm-4-8.2c.6 0 1.1-.5 1.1-1.1v-6.5c0-.6-.5-1.1-1.1-1.1-.6 0-1.1.5-1.1 1.1v6.5c0 .6.5 1.1 1.1 1.1zm0-13c.6 0 1.1-.5 1.1-1.1v-6.5c0-.6-.5-1.1-1.1-1.1-.6 0-1.1.5-1.1 1.1v6.5c0 .6.5 1.1 1.1 1.1zm4-19.1h-4c-.6 0-1.1.5-1.1 1.1v4c0 .6.5 1.1 1.1 1.1.6 0 1.1-.5 1.1-1.1V7.3h2.9c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1zm35.2 0h-8.8c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h8.8c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1zm-17.6 0h-8.8c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h8.8c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1zm30.3 0h-4c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h2.9v2.9c0 .6.5 1.1 1.1 1.1.6 0 1.1-.5 1.1-1.1v-4c.1-.6-.4-1.1-1.1-1.1zm0 23.4c-.6 0-1.1.5-1.1 1.1v6.5c0 .6.5 1.1 1.1 1.1.6 0 1.1-.5 1.1-1.1v-6.5c.1-.6-.4-1.1-1.1-1.1zm0-13c-.6 0-1.1.5-1.1 1.1v6.5c0 .6.5 1.1 1.1 1.1.6 0 1.1-.5 1.1-1.1v-6.5c.1-.6-.4-1.1-1.1-1.1z"></path>
                                        <circle cx="13.1" cy="13.4" r="13" fill="#198FD9"></circle>
                                    </g>
                                </svg>
                            </div>
                            <div class="create-domain-box-item-2">
                                <h4>Build from scratch</h4>
                                <p>Create unique lessons by stacking modular media, text, and interactive blocks in any order you want. Then customize them with your own content.</p>
                            </div>
                        </div>  
                        <video class="create-domain-img" src="https://riseusercontent.com/assets/rise/assets/marketing-animations/build-from-scratch.mp4" preload="auto" loop="" playsinline="" webkit-playsinline="" x5-playsinline="" style="width: 100%; height: 100%;" autoplay=""></video>
                    </div>
                    <div id="step5-use-prebuilt-content">
                        <div class="create-domain-box">
                            <div class="create-domain-box-item-1">
                                <svg viewBox="0 0 67 63">
                                    <defs><path id="howitworks-3_2_svg__a" d="M0 62.484h66.104V0H0z"></path></defs>
                                    <g fill="none" fill-rule="evenodd">
                                        <path fill="silver" d="M2.773 31.84c0 .621.504 1.125 1.125 1.125h7.7a1.125 1.125 0 000-2.25h-7.7c-.62 0-1.125.504-1.125 1.125m15.4 0c0 .621.504 1.125 1.125 1.125h7.7a1.125 1.125 0 000-2.25h-7.7c-.62 0-1.125.504-1.125 1.125m15.401 0c0 .621.504 1.125 1.125 1.125h7.699a1.125 1.125 0 000-2.25h-7.7c-.62 0-1.124.504-1.124 1.125M1.125 12.639c.621 0 1.125-.503 1.125-1.125v-1.377h4.073a1.125 1.125 0 000-2.25H1.125A1.124 1.124 0 000 9.011v2.502c0 .622.504 1.125 1.125 1.125m0 15.4c.621 0 1.125-.504 1.125-1.125v-7.7a1.125 1.125 0 00-2.25 0v7.7c0 .621.504 1.125 1.125 1.125m56.673-2.328c-.62 0-1.125.504-1.125 1.125v3.88h-6.575a1.125 1.125 0 000 2.25h7.7c.621 0 1.125-.504 1.125-1.125v-5.005c0-.62-.504-1.125-1.125-1.125"></path>
                                        <mask id="howitworks-3_2_svg__b" fill="#fff"><use xlink:href="#howitworks-3_2_svg__a"></use></mask>
                                        <path fill="#393633" d="M2.25 60.234h54.423v-20.58H2.25v20.58zm55.548-22.83H1.125A1.128 1.128 0 000 38.53v22.829c0 .62.504 1.125 1.125 1.125h56.673c.621 0 1.125-.504 1.125-1.125v-22.83c0-.62-.504-1.124-1.125-1.124z" mask="url(#howitworks-3_2_svg__b)"></path>
                                        <path fill="#393633" d="M28.218 48.245h21.217a1.125 1.125 0 000-2.25H28.218a1.125 1.125 0 100 2.25m0 6.004h13.783a1.125 1.125 0 100-2.25H28.218a1.125 1.125 0 100 2.25" mask="url(#howitworks-3_2_svg__b)"></path>
                                        <path fill="#FFF" d="M9.305 23.954h55.674V1.124H9.305z" mask="url(#howitworks-3_2_svg__b)"></path>
                                        <path stroke="#393633" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25" d="M9.305 23.954h55.674V1.124H9.305z" mask="url(#howitworks-3_2_svg__b)"></path>
                                        <path fill="#198FD9" d="M44.31 12.54l-10.967 6.275V6.263z" mask="url(#howitworks-3_2_svg__b)"></path>
                                        <path fill="silver" d="M14.6 43.649a6.295 6.295 0 100 12.59 6.295 6.295 0 006.295-6.295H14.6v-6.295z" mask="url(#howitworks-3_2_svg__b)"></path>
                                        <path fill="#198FD9" d="M15.916 42.333a6.295 6.295 0 016.296 6.295h-6.296v-6.295z" mask="url(#howitworks-3_2_svg__b)"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="create-domain-box-item-2">
                                <h4>Use prebuilt content</h4>
                                <p>Start from a template, tweak our sample courses, or choose from hundreds of ready-to-go, customizable lessons on practical business topics.</p>
                            </div>
                        </div>  
                        <video class="create-domain-img" src="https://riseusercontent.com/assets/rise/assets/marketing-animations/prebuilt-content.mp4" preload="auto" loop="" playsinline="" webkit-playsinline="" x5-playsinline="" style="width: 100%; height: 100%;" autoplay=""></video>
                    </div>
                    <div id="step6-importparty-training">
                        <div class="create-domain-box">
                            <div class="create-domain-box-item-1">
                                <svg viewBox="0 0 67 63">
                                    <path fill="#C1C0C0" d="M64 21.5h-3.7c-.6 0-1.2.5-1.2 1.2s.5 1.2 1.2 1.2h2.5v2c0 .6.5 1.2 1.2 1.2.6 0 1.2-.5 1.2-1.2v-3.2c0-.7-.5-1.2-1.2-1.2zm0 20.3c-.6 0-1.2.5-1.2 1.2v5.7c0 .6.5 1.2 1.2 1.2.6 0 1.2-.5 1.2-1.2V43c0-.7-.5-1.2-1.2-1.2zm0-11.5c-.6 0-1.2.5-1.2 1.2v5.7c0 .6.5 1.2 1.2 1.2.6 0 1.2-.5 1.2-1.2v-5.7c0-.6-.5-1.2-1.2-1.2zm0 22.9c-.6 0-1.2.5-1.2 1.2v2h-2c-.6 0-1.2.5-1.2 1.2 0 .6.5 1.2 1.2 1.2H64c.6 0 1.2-.5 1.2-1.2v-3.2c0-.7-.5-1.2-1.2-1.2zm-31 3.1h-5.6c-.6 0-1.2.5-1.2 1.2 0 .6.5 1.2 1.2 1.2H33c.7 0 1.2-.5 1.2-1.2-.1-.6-.6-1.2-1.2-1.2zm22.3 0h-5.6c-.6 0-1.2.5-1.2 1.2 0 .6.5 1.2 1.2 1.2h5.6c.6 0 1.2-.5 1.2-1.2-.1-.6-.6-1.2-1.2-1.2zm-11.1 0h-5.6c-.6 0-1.2.5-1.2 1.2 0 .6.5 1.2 1.2 1.2h5.6c.6 0 1.2-.5 1.2-1.2-.1-.6-.6-1.2-1.2-1.2zm-22.3 0h-2v-2c0-.6-.5-1.2-1.2-1.2-.6 0-1.2.5-1.2 1.2v3.2c0 .6.5 1.2 1.2 1.2h3.2c.6 0 1.2-.5 1.2-1.2-.1-.6-.6-1.2-1.2-1.2z"></path>
                                    <path fill="C1C0C0" d="M18.7 50.5c.6 0 1.2-.5 1.2-1.2v-3.2c0-.6-.5-1.2-1.2-1.2-.6 0-1.2.5-1.2 1.2v3.2c.1.7.6 1.2 1.2 1.2z"></path>
                                    <g fill="#333">
                                        <path d="M56.1 7.5H31.5l-7.1-5.7c-.2-.2-.4-.3-.7-.3H8c-.7 0-1.2.5-1.2 1.2v4.9H2.7c-.7-.1-1.2.5-1.2 1.1v37c0 .6.5 1.2 1.2 1.2h53.4c.6 0 1.2-.5 1.2-1.2v-37c0-.6-.6-1.2-1.2-1.2zm-1.3 37h-51V9.9H8c.6 0 1.2-.5 1.2-1.2V3.8h14.1l7.1 5.7c.2.2.4.3.7.3h23.7v34.7z"></path>
                                        <path d="M20.4 27.8c-.2-.1-.4-.2-.6-.2-.2 0-.4 0-.6.2-.1.2-.2.4-.2.6 0 .2.1.4.2.6.2.1.4.2.6.2.2 0 .4 0 .6-.2.2-.2.3-.4.3-.6 0-.2-.1-.5-.3-.6zm1.3-4.4v1h3l-3.1 4.7h5v-.9h-3.1l3.1-4.8zm6.2 0H29v5.7h-1.1zm.5-3.1c-.2 0-.4.1-.6.3-.1.2-.2.4-.2.6 0 .3.1.5.2.6.2.1.4.2.6.2.2 0 .4 0 .6-.2.2-.2.3-.4.3-.6 0-.2-.1-.4-.3-.6-.2-.2-.4-.3-.6-.3zm3.6 2.9h-1.1v8.9H32V28c.2.3.5.6.8.8.3.2.7.3 1.2.3.4 0 .8 0 1.2-.2.4-.1.7-.3 1-.6.3-.3.5-.5.6-1 .1-.4.2-.7.2-1.2 0-.4-.1-.8-.2-1.2-.2-.3-.4-.6-.6-1-.3-.2-.6-.4-1-.6-.3-.1-.7-.2-1.2-.2-.4 0-.8.1-1.2.3-.4.2-.6.5-.8.8v-1zm.1 2.3c.1-.2.2-.4.4-.6.2-.2.4-.3.6-.4.3-.1.5-.2.8-.2.3 0 .5 0 .7.2.3.1.4.2.6.4.2.2.3.4.4.6.1.2.1.4.1.7 0 .2 0 .5-.1.7-.1.2-.2.4-.4.6-.2.2-.4.3-.6.4-.2.1-.4.2-.7.2-.3 0-.6-.1-.8-.2-.2-.1-.4-.2-.6-.4-.2-.2-.3-.4-.4-.6-.1-.1-.1-.3-.1-.6 0-.2 0-.5.1-.8z"></path>
                                    </g>
                                    <circle cx="43.5" cy="43.8" r="7.4" fill="#198FD9"></circle>
                                    <path fill="#FFF" d="M42.491 46.601l4.172-4.171 1.414 1.414-4.172 4.172z"></path>
                                    <path fill="#FFF" d="M42.484 40.985l1.415-1.414 4.171 4.172-1.414 1.414z"></path>
                                    <path fill="#FFF" d="M39.8 42.8h5.9v2h-5.9z"></path>
                                </svg>
                            </div>
                            <div class="create-domain-box-item-2">
                                <h4>Import third-party training</h4>
                                <p>If you’d like to manage, distribute, and track all of your training in one system, you can upload other SCORM content into Rise as well.</p>
                            </div>
                        </div> 
                        <video class="create-domain-img" src="https://riseusercontent.com/assets/rise/assets/marketing-animations/import-third-party-content.mp4" preload="auto" loop="" playsinline="" webkit-playsinline="" x5-playsinline="" autoplay="" style="width: 100%; height: 100%;"></video> 
                    </div>
                </div>
                <div class="section-stick">
                    <div class="sign-upposi header-color">
                        <div class="msign-up-text">
                            <a class="msignmain-menu" href="#step7-mpublish-training"><span class="mobile-number-bg">4</span> Publish & Enroll <span class="mobile-iconhit"><i class="fa-solid fa-chevron-up"></i></span></a>
                            <div class="mo-hit-menuclick">
                                <a class="msignmain-menu step-1mosignmenu" href="#step1-mcreate-domain"><span class="mobile-number-bg">1 </span> Sign Up </a>
                                <a class="msignmain-menu" href="#step3-minvitepeople"><span class="mobile-number-bg">2</span> Invite People </a>
                                <a class="msignmain-menu" href="#step4-mbuild-scratch"><span class="mobile-number-bg">3</span> Create Training </a>
                                <a class="msignmain-menu mobile-active" href="#step7-mpublish-training"><span class="mobile-number-bg">4</span> Publish & Enroll </a>
                                <a class="msignmain-menu" href="#step8-mdiscover-learn"><span class="mobile-number-bg">5</span> Train </a>
                                <a class="msignmain-menu" href="#step9-manalyze-impact"><span class="mobile-number-bg">6</span> Analyze </a>
                                <a class="msignmain-menu" href="#step10-mintegrations"><span class="mobile-number-bg">7</span> Integrations </a>
                            </div>
                        </div>
                    </div>
                    <div id="step7-mpublish-training">
                        <div class="create-domain-box">
                            <div class="create-domain-box-item-1">
                                <svg viewBox="0 0 58 53">
                                    <g fill="none">
                                        <path fill="#383632" d="M49.3 45.8h-48c-.6 0-1.1-.5-1.1-1.1V1.3C.2.7.7.2 1.3.2h48c.6 0 1.1.5 1.1 1.1v43.4c0 .6-.5 1.1-1.1 1.1zM2.4 43.6h45.8V2.4H2.4v41.2z"></path>
                                        <path fill="#8D8E8E" d="M33.7 15.1h8.9c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1h-8.9c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1zm9.6 16H8.7c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h34.6c.6 0 1.1-.5 1.1-1.1 0-.6-.4-1.1-1.1-1.1z"></path>
                                        <path fill="#BFBFBF" d="M8 6.9h21.1v19.7H8zM33.7 9h8.9c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1h-8.9c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1zm0 12.2h8.9c.6 0 1.1-.5 1.1-1.1 0-.6-.5-1.1-1.1-1.1h-8.9c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1zm9.6 15.9H8.7c-.6 0-1.1.5-1.1 1.1 0 .6.5 1.1 1.1 1.1h34.6c.6 0 1.1-.5 1.1-1.1 0-.6-.4-1.1-1.1-1.1z"></path>
                                        <circle cx="42.5" cy="37.3" r="15" fill="#198FD9"></circle>
                                        <path fill="#FFF" d="M46.1 34.5l-5.6-5.6-2.8 2.8 5.6 5.6-5.6 5.6 2.8 2.8 8.4-8.4z"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="create-domain-box-item-2">
                                <h4>Publish training and enroll learners</h4>
                                <p>Publish the training to your library, tag with a category, and enroll individuals or groups as learners. You can also choose to let learners self‑enroll.</p>
                            </div>
                        </div>  
                        <img src="{{ asset('frontend/img/publish-training-img.png')}}" class="img-fluid create-domain-img" alt="">
                    </div>
                </div>
                <div class="section-stick">
                    <div class="sign-upposi header-color">
                        <div class="msign-up-text">
                            <a class="msignmain-menu" href="#step8-mdiscover-learn"><span class="mobile-number-bg">5</span> Train <span class="mobile-iconhit"><i class="fa-solid fa-chevron-up"></i></span></a>
                            <div class="mo-hit-menuclick">
                                <a class="msignmain-menu step-1mosignmenu" href="#step1-mcreate-domain"><span class="mobile-number-bg">1 </span> Sign Up </a>
                                <a class="msignmain-menu" href="#step3-minvitepeople"><span class="mobile-number-bg">2</span> Invite People </a>
                                <a class="msignmain-menu" href="#step4-mbuild-scratch"><span class="mobile-number-bg">3</span> Create Training </a>
                                <a class="msignmain-menu" href="#step7-mpublish-training"><span class="mobile-number-bg">4</span> Publish & Enroll </a>
                                <a class="msignmain-menu mobile-active" href="#step8-mdiscover-learn"><span class="mobile-number-bg">5</span> Train </a>
                                <a class="msignmain-menu" href="#step9-manalyze-impact"><span class="mobile-number-bg">6</span> Analyze </a>
                                <a class="msignmain-menu" href="#step10-mintegrations"><span class="mobile-number-bg">7</span> Integrations </a>
                            </div>
                        </div>
                    </div>
                    <div id="step8-mdiscover-learn">
                        <div class="create-domain-box">
                            <div class="create-domain-box-item-1">
                                <svg viewBox="0 0 64 59">
                                    <g fill="none">
                                        <path fill="#BFBFBF" d="M14.8 9.9c0-3-2.4-5.4-5.4-5.4-3 0-5.4 2.4-5.4 5.4m53.6 41c0-6.8-5.6-12.4-12.4-12.4-6.8 0-12.4 5.6-12.4 12.4"></path>
                                        <path fill="#383632" d="M29.4.3C13.3.3.1 13.4.1 29.6c0 16.2 13.1 29.3 29.3 29.3 16.1 0 29.3-13.1 29.3-29.3C58.7 13.4 45.6.3 29.4.3zM2.5 30.7h11.3c.1 4.5 1.1 8.7 2.7 12.7H6.2C4 39.7 2.7 35.3 2.5 30.7zm28.1-17.2V3.7c3.4 2.8 6.2 6.1 8.3 9.8h-8.3zm9.4 2.3c1.8 3.9 2.8 8.2 2.9 12.7H30.6V15.8H40zm-11.7-2.3H20c2.1-3.7 4.8-7.1 8.3-9.8v9.8zm0 2.3v12.7H16c.1-4.5 1.1-8.8 2.9-12.7h9.4zM13.7 28.5H2.5c.2-4.6 1.5-8.9 3.8-12.7h10.2c-1.7 3.9-2.6 8.2-2.8 12.7zm2.3 2.2h12.3v12.7h-9.4c-1.8-3.9-2.8-8.2-2.9-12.7zm12.3 15v9.8c-3.4-2.8-6.2-6.1-8.3-9.8h8.3zm2.3 0h8.3c-2.1 3.7-4.8 7.1-8.3 9.8v-9.8zm0-2.3V30.7h12.3c-.1 4.5-1.1 8.8-2.9 12.7h-9.4zm14.5-12.7h11.3c-.2 4.6-1.5 8.9-3.8 12.7H42.4c1.7-3.9 2.6-8.2 2.7-12.7zm0-2.2C45 24 44 19.8 42.4 15.8h10.2c2.2 3.7 3.6 8.1 3.8 12.7H45.1zm6-15h-9.8c-2-4-4.9-7.7-8.4-10.7 7.5 1 14 5 18.2 10.7zM25.9 2.8c-3.5 3-6.4 6.7-8.4 10.7H7.7C12 7.8 18.5 3.8 25.9 2.8zM7.7 45.7h9.8c2 4 4.9 7.7 8.4 10.7-7.4-1-13.9-5-18.2-10.7zM33 56.4c3.5-3 6.4-6.7 8.4-10.7h9.8c-4.3 5.7-10.8 9.7-18.2 10.7z"></path>
                                        <circle cx="51.2" cy="13.6" r="12.5" fill="#198FD9"></circle>
                                        <path fill="#BFBFBF" d="M22.9 10.6c-7.1 0-12.9 5.8-12.9 12.9 0 7.1 12.9 20.1 12.9 20.1s12.9-13 12.9-20.1c0-7.1-5.8-12.9-12.9-12.9zm0 15.7c-2.5 0-4.6-2-4.6-4.6 0-2.5 2-4.6 4.6-4.6 2.6 0 4.6 2 4.6 4.6 0 2.6-2.1 4.6-4.6 4.6z"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="create-domain-box-item-2">
                                <h4>Discover and learn</h4>
                                <p>Learners take courses, view scores, and download completion certificates. And they discover new training material by browsing your library by category.</p>
                            </div>
                        </div>  
                        <img src="{{ asset('frontend/img/discover-learn-img.png')}}" class="img-fluid create-domain-img" alt="">
                    </div>
                </div>
                <div class="section-stick">
                    <div class="sign-upposi header-color">
                        <div class="msign-up-text">
                            <a class="msignmain-menu" href="#step9-manalyze-impact"><span class="mobile-number-bg">6</span> Analyze <span class="mobile-iconhit"><i class="fa-solid fa-chevron-up"></i></span></a>
                            <div class="mo-hit-menuclick">
                                <a class="msignmain-menu step-1mosignmenu" href="#step1-mcreate-domain"><span class="mobile-number-bg">1 </span> Sign Up </a>
                                <a class="msignmain-menu" href="#step3-minvitepeople"><span class="mobile-number-bg">2</span> Invite People </a>
                                <a class="msignmain-menu" href="#step4-mbuild-scratch"><span class="mobile-number-bg">3</span> Create Training </a>
                                <a class="msignmain-menu" href="#step7-mpublish-training"><span class="mobile-number-bg">4</span> Publish & Enroll </a>
                                <a class="msignmain-menu" href="#step8-mdiscover-learn"><span class="mobile-number-bg">5</span> Train </a>
                                <a class="msignmain-menu mobile-active" href="#step9-manalyze-impact"><span class="mobile-number-bg">6</span> Analyze </a>
                                <a class="msignmain-menu" href="#step10-mintegrations"><span class="mobile-number-bg">7</span> Integrations </a>
                            </div>
                        </div>
                    </div>
                    <div id="step9-manalyze-impact">
                        <div class="create-domain-box">
                            <div class="create-domain-box-item-1">
                                <svg viewBox="0 0 63 51">
                                    <g fill="none">
                                        <path fill="#198FD9" d="M44.5 33.4l-2.5 5-5.6.9 6.4 8.8c1.6 2.2 4.7 2.7 7 1.1 2.2-1.6 2.7-4.7 1.1-7l-6.4-8.8zm-32.3-9.8L1.1 34.7c-.4.4-.4 1.2 0 1.6.2.2.5.3.8.3.3 0 .6-.1.8-.3l10.2-10.2c.4-.4.4-1.2 0-1.6-.4-.4-.3-1.3-.7-.9zM59 4.2c-.4-.5-1.1-.5-1.6-.1L46.3 14.4c-.5.4.3 1 .7 1.5.2.3-.3.5 0 .5.2 0 .5-.1.7-.3L58.9 5.8c.5-.4.5-1.1.1-1.6zM43.6 19.6l-8.3 8.1-11.1-10.9-8.1 8.3 1.6 1.6 6.5-6.7 11.1 10.8 9.9-9.6z"></path>
                                        <path fill="#8C8D8E" d="M48.9 39.5l-4.3-6-3.3 4.3-4.9 1.5 1.2 1.6z" opacity="0.45"></path>
                                        <path fill="#BFBFBF" d="M9.9.5c-3 0-5.4 2.4-5.4 5.4h10.8c0-3-2.4-5.4-5.4-5.4zm48.2 23.3c-2.5 0-4.5 2-4.5 4.5h9c0-2.5-2-4.5-4.5-4.5zM20.6 44.3c-1 0-2 .6-2.5 1.4-.7-3.1-3.4-5.4-6.7-5.4-3.8 0-6.9 3.1-6.9 6.9h19c0-1.6-1.3-2.9-2.9-2.9z"></path>
                                        <path fill="#383632" d="M30.6 37.8c-4.7 0-9.3-2.2-12.3-6.3-4.9-6.8-3.4-16.3 3.4-21.1C25 8 29 7.1 33 7.7c4 .6 7.5 2.8 9.9 6.1 4.9 6.8 3.4 16.3-3.4 21.1-2.7 2-5.8 2.9-8.9 2.9zm-10.5-7.6c4.2 5.8 12.2 7.1 18 2.9 5.8-4.2 7.1-12.2 2.9-18-2-2.8-5-4.6-8.4-5.2-3.4-.5-6.8.3-9.6 2.3-5.7 4.2-7 12.2-2.9 18z"></path>
                                        <g fill="#383632">
                                            <path d="M46.4 11.2c-3.1-4.2-7.6-7-12.7-7.8-5.1-.9-10.3.4-14.5 3.4-8.7 6.3-10.7 18.5-4.4 27.2 3.8 5.3 9.8 8.1 15.8 8.1 4 0 7.9-1.2 11.4-3.7 4.2-3.1 7-7.6 7.8-12.7.9-5.1-.4-10.3-3.4-14.5zm1.1 14.2c-.7 4.5-3.2 8.5-6.9 11.2-7.7 5.5-18.4 3.8-24-3.9-5.5-7.7-3.8-18.4 3.9-24 3.7-2.7 8.3-3.7 12.8-3 4.5.7 8.5 3.2 11.2 6.9 2.7 3.7 3.7 8.3 3 12.8z"></path>
                                            <path d="M33 7.7c-4-.6-8 .3-11.3 2.7-6.8 4.8-8.3 14.3-3.4 21.1 3 4.1 7.6 6.3 12.3 6.3 3.1 0 6.2-.9 8.9-2.9 6.8-4.8 8.3-14.3 3.4-21.1-2.4-3.3-5.9-5.5-9.9-6.1zm5.1 25.4c-5.8 4.2-13.8 2.9-18-2.9-4.1-5.8-2.8-13.8 2.9-18 2.8-2 6.2-2.8 9.6-2.3 3.4.6 6.4 2.4 8.4 5.2 4.2 5.8 2.9 13.8-2.9 18z"></path>
                                        </g>
                                        <path fill="#198FD9" d="M58.9 10.5c-.6 0-1.1-.5-1.1-1.1V5.1h-4.3c-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1h5.4c.6 0 1.1.5 1.1 1.1v5.4c0 .6-.5 1.1-1.1 1.1z"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="create-domain-box-item-2">
                                <h4>Analyze the impact</h4>
                                <p>See what training materials learners have accessed, the time they’ve spent learning, and the lessons they’ve completed. Drill into any content to view enrollees, learner progress, question level reporting, quiz scores, and more.</p>
                            </div>
                        </div>  
                        <img src="{{ asset('frontend/img/analyze-img.png')}}" class="img-fluid create-domain-img" alt="">
                    </div>
                </div>
                <div class="section-stick">
                    <div class="sign-upposi header-color">
                        <div class="msign-up-text">
                            <a class="msignmain-menu" href="#step10-mintegrations"><span class="mobile-number-bg">7</span> Integrations <span class="mobile-iconhit"><i class="fa-solid fa-chevron-up"></i></span></a>
                            <div class="mo-hit-menuclick">
                                <a class="msignmain-menu step-1mosignmenu" href="#step1-mcreate-domain"><span class="mobile-number-bg">1 </span> Sign Up </a>
                                <a class="msignmain-menu" href="#step3-minvitepeople"><span class="mobile-number-bg">2</span> Invite People </a>
                                <a class="msignmain-menu" href="#step4-mbuild-scratch"><span class="mobile-number-bg">3</span> Create Training </a>
                                <a class="msignmain-menu" href="#step7-mpublish-training"><span class="mobile-number-bg">4</span> Publish & Enroll </a>
                                <a class="msignmain-menu" href="#step8-mdiscover-learn"><span class="mobile-number-bg">5</span> Train </a>
                                <a class="msignmain-menu" href="#step9-manalyze-impact"><span class="mobile-number-bg">6</span> Analyze </a>
                                <a class="msignmain-menu mobile-active" href="#step10-mintegrations"><span class="mobile-number-bg">7</span> Integrations </a>
                            </div>
                        </div>
                    </div>
                    <div id="step10-mintegrations">
                        <div class="create-domain-box">
                            <div class="create-domain-box-item-1">
                                <svg fill="none" viewBox="0 0 72 57">
                                    <clipPath id="howitworks-7_svg__a">
                                        <path d="M0 0h72v57H0z"></path>
                                    </clipPath>
                                    <g clip-path="url(#howitworks-7_svg__a)">
                                        <path fill="#bfbfbf" d="M46.51 54.517c-2.714-.62-4.904-2.748-5.517-5.496-3.329.09-6.657-.354-9.81-.088-.614 2.748-2.803 4.964-5.519 5.585-.963.177-1.664 1.063-1.664 2.127V57h24.175v-.355c0-.975-.7-1.862-1.664-2.128z"></path>
                                        <path fill="#8d8d8e" d="M43.007 52.567a7.96 7.96 0 01-2.014-3.546c-3.329.09-6.658-.354-9.81-.088a6.304 6.304 0 01-.964 2.216z" opacity="0.45"></path>
                                        <path stroke="#393633" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.25" d="M12.768 48.783h46.336v-30.14H12.768z"></path>
                                        <path stroke="#bfbfbf" stroke-miterlimit="10" stroke-width="2" d="M10.686 32.8l24.963 7.535 25.665-7.092M35.65 40.334V16.577"></path>
                                        <path fill="#198FD9" d="M36 24c5.523 0 10-4.477 10-10S41.523 4 36 4 26 8.477 26 14s4.477 10 10 10zM10.5 41c4.142 0 7.5-3.582 7.5-8s-3.358-8-7.5-8C6.358 25 3 28.582 3 33s3.358 8 7.5 8zm51 0c4.142 0 7.5-3.582 7.5-8s-3.358-8-7.5-8-7.5 3.582-7.5 8 3.358 8 7.5 8zm-25.85 3.324c2.177 0 3.941-1.786 3.941-3.99s-1.765-3.988-3.941-3.988-3.942 1.786-3.942 3.989 1.765 3.989 3.942 3.989z"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="create-domain-box-item-2">
                                <h4>Integrations</h4>
                                <p>See what training materials learners have accessed, the time they’ve spent learning, and the lessons they’ve completed. Drill into any content to view enrollees, learner progress, question level reporting, quiz scores, and more.</p>
                            </div>
                        </div>  
                        <img src="{{ asset('frontend/img/integrations-img.png')}}" class="img-fluid create-domain-img" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="watching-overview-bg">
        <div class="container">
            <div class="watch-webinar-box">
                <svg fill="none" viewBox="0 0 71 57">
                    <path fill="#E5E5E5" d="M37.76 37.89a4.36 4.36 0 10-3.75 0 9.62 9.62 0 00-3 6.42 1.896 1.896 0 000 .25h9.69a1.896 1.896 0 000-.25 9.621 9.621 0 00-2.94-6.42zm-23.22 0a4.35 4.35 0 10-3.74 0 9.62 9.62 0 00-3 6.42 1.903 1.903 0 000 .25h9.74v-.25a9.59 9.59 0 00-3-6.42z"></path>
                    <path fill="#E5E5E5" d="M63.01 24.28a9.7 9.7 0 00-3-5.9 4.36 4.36 0 10-3.74 0 9.66 9.66 0 00-3 5.9h-6V6.76h-1v17.57h-5.64a9.7 9.7 0 00-3-5.9 4.361 4.361 0 10-3.75 0 9.7 9.7 0 00-3 5.9h-6.41v-8.59a4.567 4.567 0 01-1 0v8.57h-21v1h21v18.14h1V25.31h21.72v18.14h1V25.31h20.63v-1l-4.81-.03z"></path>
                    <path fill="#E5E5E5" d="M64.02 33.08c-.41-2.51-2.62-2.57-3.33-1.6a4.29 4.29 0 00-3.35-1.61 4.34 4.34 0 00-1.87 8.27 9.67 9.67 0 00-3 6.43h9.74a9.67 9.67 0 00-3-6.43c.8-.382 1.462-1 1.9-1.77a2.93 2.93 0 005 .25s-1.52.01-2.09-3.54z"></path>
                    <path fill="#BFBFBF" d="M69.06 1.88H2.62v4.83h66.44V1.88zm-18.41 51a10.74 10.74 0 01-8-8c-4.78.1-9.72-.46-14.32-.11a10.75 10.75 0 01-8.07 8.08 3.08 3.08 0 00-2.38 3v.51h35.2v-.51a3.09 3.09 0 00-2.43-2.97z"></path>
                    <path fill="#8D8D8E" d="M45.54 50.07a10.7 10.7 0 01-2.93-5.16c-4.78.1-9.72-.46-14.32-.11a10.87 10.87 0 01-1.36 3.25l18.61 2.02z" opacity="0.45"></path>
                    <path fill="#393633" d="M69.06 45.67H1.63A1.13 1.13 0 01.5 44.54V1.12A1.12 1.12 0 011.63 0h67.43a1.13 1.13 0 011.13 1.12v43.42a1.14 1.14 0 01-1.13 1.13zM2.75 43.42h65.19V2.25H2.75v41.17z"></path>
                    <path fill="#198FD9" d="M15.64 18.38a4.34 4.34 0 00-1.87-8.27 4.289 4.289 0 00-3.35 1.61c-.71-1-2.92-.91-3.33 1.6-.57 3.55-2.06 3.54-2.06 3.54a2.93 2.93 0 005-.25 4.39 4.39 0 001.9 1.77 9.71 9.71 0 00-3 6h9.7a9.71 9.71 0 00-2.99-6zm8.45-13.35a5.35 5.35 0 00-5.35 5.35 5.291 5.291 0 001.92 4.07 3.709 3.709 0 01-1.39 3s2.7 0 3.58-1.91a5.08 5.08 0 001.24.16 5.35 5.35 0 100-10.7v.03z"></path>
                    <path fill="#fff" d="M21.93 11.13a.75.75 0 100-1.5.75.75 0 000 1.5zm2.15 0a.75.75 0 100-1.5.75.75 0 000 1.5zm2.16 0a.75.75 0 100-1.5.75.75 0 000 1.5z"></path>
                </svg>
                <p class="learn-more-watch-text">Learn more by watching this overview webinar</p>
                <p>See Rise in action in this overview webinar led by our helpful team </p>
                <button>Watch</button>
            </div>
            <hr>
        </div>
    </div>

    <div class="container">
        <div class="gbgc-text-empoyees-text">
            <svg viewBox="0 0 48 48"><path fill="#198FD9" d="M24 0C10.74 0 0 10.74 0 24s10.74 24 24 24 24-10.74 24-24C47.956 10.74 37.215 0 24 0zm0 40.707c-7.293 0-13.48-4.64-15.779-11.182h31.558C37.481 36.066 31.249 40.707 24 40.707z"></path></svg>
            <p>Herodikus is the online training system your employees will love</p>
            <a href="#" style="text-decoration: none;"><button>Contact Us</button></a>
        </div>
    </div> 

@endsection
@section('js')
<script>
    $(document).ready(function(){
        $('.msignmain-menu').click(function(){
            if($(this).siblings('.mo-hit-menuclick').is(':visible')){
                $('.mo-hit-menuclick').css("display", "none");
                $(this).find('.mobile-iconhit svg').removeClass('fa-chevron-down');    
                $(this).find('.mobile-iconhit svg').addClass('fa-chevron-up');    
            }else{
                $('.mo-hit-menuclick').css("display", "none");
                $(this).siblings('.mo-hit-menuclick').toggle('slow');
                $(this).find('.mobile-iconhit svg').removeClass('fa-chevron-up');    
                $(this).find('.mobile-iconhit svg').addClass('fa-chevron-down');    
            }
            
        });
    });
</script>
@endsection