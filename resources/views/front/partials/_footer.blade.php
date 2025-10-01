<!-- Footer -->
<footer class="footer text-center text-light">
    <div class="container d-flex align-items-center justify-content-between py-4">
        <p class="mb-0">@lang('custom.copyright')</p>
        <ul class="list-unstyled d-flex align-items-center gap-3 mb-0">
            @if ($website_settings->facebook_url)
                <li>
                    <a href="{{ $website_settings->facebook_url }}"><i class="fa-brands fa-square-facebook fs-4"></i></a>
                </li>
            @endif
            @if ($website_settings->instagram_url)
                <li>
                    <a href="{{ $website_settings->instagram_url }}"><i class="fa-brands fa-square-instagram fs-4"></i></a>
                </li>
            @endif
            @if ($website_settings->twitter_url)
                <li>
                    <a href="{{ $website_settings->twitter_url }}"><i class="fa-brands fa-square-x-twitter fs-4"></i></a>
                </li>
            @endif
            @if ($website_settings->linkedin_url)
                <li>
                    <a href="{{ $website_settings->linkedin_url }}"><i class="fa-brands fa-linkedin fs-4"></i></a>
                </li>
            @endif
            @if ($website_settings->tiktok_url)
                <li>
                    <a href="{{ $website_settings->tiktok_url }}"><i class="fa-brands fa-tiktok fs-4"></i></a>
                </li>
            @endif
            @if ($website_settings->snapchat_url)
                <li>
                    <a href="{{ $website_settings->snapchat_url }}"><i class="fa-brands fa-snapchat fs-4"></i></a>
                </li>
            @endif
            @if ($website_settings->youtube_url)
                <li>
                    <a href="{{ $website_settings->youtube_url }}"><i class="fa-brands fa-youtube fs-4"></i></a>
                </li>
            @endif
            @if ($website_settings->whatsapp)
                <li>
                    <a href="https://iwtsp.com/{{ $website_settings->whatsapp }}"><i class="fa-brands fa-whatsapp fs-4"></i></a>
                </li>
            @endif
            @if ($website_settings->phone_number)
                <li>
                    <a href="tel:{{ $website_settings->phone_number }}"><i class="fa-solid fa-phone fs-4"></i></a>
                </li>
            @endif
        </ul>
    </div>
</footer>