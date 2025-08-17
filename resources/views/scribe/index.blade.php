<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.2.1.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.2.1.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-jenis-sampah">
                                <a href="#endpoints-GETapi-jenis-sampah">API endpoint untuk mendapatkan data jenis sampah</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-jadwal-tersedia">
                                <a href="#endpoints-GETapi-jadwal-tersedia">Mendapatkan daftar jadwal penjemputan yang tersedia</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-chart-data">
                                <a href="#endpoints-GETapi-chart-data">API endpoint untuk data chart pie</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-refresh-stats">
                                <a href="#endpoints-GETapi-refresh-stats">API endpoint untuk refresh dashboard stats</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-monthly-trends">
                                <a href="#endpoints-GETapi-monthly-trends">Get monthly transaction trends (contoh tambahan, tidak digunakan di view saat ini)</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: June 16, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-jenis-sampah">API endpoint untuk mendapatkan data jenis sampah</h2>

<p>
</p>



<span id="example-requests-GETapi-jenis-sampah">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/jenis-sampah" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/jenis-sampah"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-jenis-sampah">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6IlB3Vmh6eE9LWUZvWUVwaEhiMHJCbXc9PSIsInZhbHVlIjoieENFL0VxS0ZsMTR0U2dVRExQQnNlSFNkVVR1NWg4SStFQ2M3SkhQeGlCeFhDZ0RyVUNaQmNEeVZvb0hNQVhpNklvbGVpalo0eWlnMWlxcC9wL0l1dUtiSU51S0o1Qlp5eU1LRDVRR0Vqc3MxUEpkV0lvcVZ2UlgxOGNzK3JNamkiLCJtYWMiOiJkMzgxN2JhMTdjODQyOTFlNDA2ZWIzYzdiOTM4ZTc4YmY2NzJhMDgzN2VhNTRkNTRiMzZkNDgzYmEwMDY1MTU4IiwidGFnIjoiIn0%3D; expires=Mon, 16 Jun 2025 13:05:43 GMT; Max-Age=7200; path=/; samesite=lax; laravel_session=eyJpdiI6ImphZVlhSXJiNHpZYTU3VFBNZzluK3c9PSIsInZhbHVlIjoiUkJHRnpDelRkbTlaZERXb0pjQVhsT0JSQ3BVaEF5SWFuaEF6UkhDR1Q5VmJsbk1QNVlmaDVWRUJhQ3dtazJsalUvVGRiZS83amJ4Y2JZZ3JWZGMxOVowWktNZXdOb2Rwb0t5dU4rMlRMZ1hRcnM5ZVVROUJSR1duUGJqcjFpbHkiLCJtYWMiOiI4NjU5MTBiNjMwNWM4OGIzOTJmYzM0MGM1YzZkMjI4M2MzODE3NmY4MWE0YThhNWRlZGM4OGIxMWQxMDA5YzEyIiwidGFnIjoiIn0%3D; expires=Mon, 16 Jun 2025 13:05:43 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-jenis-sampah" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-jenis-sampah"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-jenis-sampah"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-jenis-sampah" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-jenis-sampah">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-jenis-sampah" data-method="GET"
      data-path="api/jenis-sampah"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-jenis-sampah', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-jenis-sampah"
                    onclick="tryItOut('GETapi-jenis-sampah');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-jenis-sampah"
                    onclick="cancelTryOut('GETapi-jenis-sampah');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-jenis-sampah"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/jenis-sampah</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-jenis-sampah"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-jenis-sampah"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-jadwal-tersedia">Mendapatkan daftar jadwal penjemputan yang tersedia</h2>

<p>
</p>



<span id="example-requests-GETapi-jadwal-tersedia">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/jadwal-tersedia" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/jadwal-tersedia"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-jadwal-tersedia">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6InZGVVptYjIvaC82SjNvQXZLRXhwOFE9PSIsInZhbHVlIjoidlpFK3VDTnkxU2ZnNWZRSmJyMThkcDBuNjZlb2tZWWFPbWNDQk9tSERTMFJObUFOcURMNlVGNm9vSGtVMFVBano3OUh4V1U4NmJxVERrM2ZROUFxK1JrV0xXZGg1OUJQT0EzbFRwdjJqQ1cwMXRtSG5nY1g4WVpQRHkxbXVFYjMiLCJtYWMiOiJiNzJiZWJiYzRlMjMzYmQ2MzJkZjQ1YjQ4Y2I0OGU5MTQwMThiMDJlNmUwMWZlNTczYjM4ZGQyZDRlOTVjMWI1IiwidGFnIjoiIn0%3D; expires=Mon, 16 Jun 2025 13:05:43 GMT; Max-Age=7200; path=/; samesite=lax; laravel_session=eyJpdiI6InlBSXQ0a0M5bVQrMTR4aUI5VXlkUEE9PSIsInZhbHVlIjoicUdnaTdqdG9LQ3BrQWJzMGswMGRBQy91clR6ZWxkb01IeUNYYkRTcXJaU0FlNmxndHNHOGhKdHFXZE1JQmNRMEtxczkrOHBtQkljMDBTblpzaHRxazR2SWptelFvT1FUS2Jwa1ltSXR4c1ZDR0huYnBZOGx5NXZqYVdoYmtZbkMiLCJtYWMiOiI3N2ZjNThiMmNlNTY3YTFlNTk0MjgwZDkyMTVlYzg0ZmViZjJiOTIyZDlmNWYyNWEwMzJhZmZmMGEyYjA2N2I4IiwidGFnIjoiIn0%3D; expires=Mon, 16 Jun 2025 13:05:43 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-jadwal-tersedia" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-jadwal-tersedia"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-jadwal-tersedia"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-jadwal-tersedia" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-jadwal-tersedia">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-jadwal-tersedia" data-method="GET"
      data-path="api/jadwal-tersedia"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-jadwal-tersedia', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-jadwal-tersedia"
                    onclick="tryItOut('GETapi-jadwal-tersedia');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-jadwal-tersedia"
                    onclick="cancelTryOut('GETapi-jadwal-tersedia');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-jadwal-tersedia"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/jadwal-tersedia</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-jadwal-tersedia"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-jadwal-tersedia"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-chart-data">API endpoint untuk data chart pie</h2>

<p>
</p>



<span id="example-requests-GETapi-chart-data">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/chart-data" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/chart-data"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-chart-data">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6ImM5YzZCajNTdWJ6VDlZeVFVWUZQd1E9PSIsInZhbHVlIjoiVkZ0T0hxSzJnMEZ4WGk2YndUcVBKbU1tMWdvaWxTM2lGTDR2QlVBVlVGczZGTGd2NnRrdHF2QnZqRkdDcEsxQXVNM2thTkNaMlc2N1oxU0I4UlFWVkVIYTl1aFRMMDl4eHJNMzVubytYZHYvYWVUWCtWa3NvZmlPNFhsanMzUVMiLCJtYWMiOiJiYmZlOWU4NmFjZjRlYTFhOWI2ODkzNmE1NjdkYTM3OWJiMzdlODNiZTRkNTRjYjFiOTg5ZjY4OTJlMzYzZGQzIiwidGFnIjoiIn0%3D; expires=Mon, 16 Jun 2025 13:05:43 GMT; Max-Age=7200; path=/; samesite=lax; laravel_session=eyJpdiI6IjJkSitjaTJCNnRHTXF6RkdTWVExTGc9PSIsInZhbHVlIjoiMlEzb0YyaURQd0lUejhESFJFM3JGUXB4RFNSMzljM1h5aU9ENWpoK0NyZ1duRXFhWDJFTW1pWnNocEFXektlQ0RnVGc1bEZjRzJFWjB2cGliaTl5dk1COEJEUm1kblVCWUptNUNha0kvRm1vMExYd3ZRU0FDTjlGRXYwZUZYYmEiLCJtYWMiOiIzMDc4MzlkYTUwYTUyYWI4Mzk2ZWEzNTBjNWI2NjczNTNkZDc1ODJhZjEyM2ZkMmM0NjAzMGU1MWJkMmIwYjFjIiwidGFnIjoiIn0%3D; expires=Mon, 16 Jun 2025 13:05:43 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-chart-data" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-chart-data"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-chart-data"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-chart-data" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-chart-data">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-chart-data" data-method="GET"
      data-path="api/chart-data"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-chart-data', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-chart-data"
                    onclick="tryItOut('GETapi-chart-data');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-chart-data"
                    onclick="cancelTryOut('GETapi-chart-data');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-chart-data"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/chart-data</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-chart-data"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-chart-data"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-refresh-stats">API endpoint untuk refresh dashboard stats</h2>

<p>
</p>



<span id="example-requests-GETapi-refresh-stats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/refresh-stats" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/refresh-stats"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-refresh-stats">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6ImRzVDF6Qm5YUVF3RXJDb0JldXVod2c9PSIsInZhbHVlIjoiNStQRWtpSHpNbVUyZndnQUFTQlk4TWdrbFV5YmxOQWk0aGJhNDcwOWNwS1YwQkFwcVFZcno4bXRWdGIzcUs5Wll4c2RLU201eGFWbWJvUzhLTXRhQzdSc1dwQkFFbzU0NGtXbmNOYTdrS2tEWnRlSVNHRWIrbEN0MzcwbFZ2MzAiLCJtYWMiOiJhZmMwZWI5ZjNjZTQzODRmM2I5Yzg2ZGZjMjg5NDk2OTcwYmU3NmEzYjg4MzYxNmVhMDMxM2ZiOWE1NmYwZjMwIiwidGFnIjoiIn0%3D; expires=Mon, 16 Jun 2025 13:05:43 GMT; Max-Age=7200; path=/; samesite=lax; laravel_session=eyJpdiI6InJTanBGTS9mREZ6VFhVQ01jZUJmQmc9PSIsInZhbHVlIjoiVHR3QWMzQ0VtazBtUWNZSFhUMFJ4RFFEZEZuSWFqTVJnZ3NINWJLM3pkeGRsclZHeHpaSFJGSUFzUTlkQVdTcU1aUm1jMWJ4MEo5Q1paTGF4blVGUldadEpGQzMxT1laT05HdkxkYmw1YnNkbERMQVFCZzJCRTRoVjhUcDhFYW8iLCJtYWMiOiI0YmU2ZTRjNzBkMzZmNTk2NGFiOGNjMjFjYjRiNzUwZjUyMGJmMDc0OGRlZTQzNzcxYzY3OTFlODk4MjBmY2E2IiwidGFnIjoiIn0%3D; expires=Mon, 16 Jun 2025 13:05:43 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-refresh-stats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-refresh-stats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-refresh-stats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-refresh-stats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-refresh-stats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-refresh-stats" data-method="GET"
      data-path="api/refresh-stats"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-refresh-stats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-refresh-stats"
                    onclick="tryItOut('GETapi-refresh-stats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-refresh-stats"
                    onclick="cancelTryOut('GETapi-refresh-stats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-refresh-stats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/refresh-stats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-refresh-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-refresh-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-monthly-trends">Get monthly transaction trends (contoh tambahan, tidak digunakan di view saat ini)</h2>

<p>
</p>



<span id="example-requests-GETapi-monthly-trends">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/monthly-trends" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/monthly-trends"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-monthly-trends">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6IlhORk96eHJoWk1WT0VOUHBlN1J6M1E9PSIsInZhbHVlIjoibE50QU83WE9WNldKUEYrSHQ4N3h3R0hXY3o0ZXB1ZTYzcVVYRU1mMDFOSk1NOFlyNktQVExVSEovVUdTL3psM2VTT1dBc0xZWmRwWUs5aTZjZ2t0NTVON05FWkxHbkVWMDZ3VjQvYllDSjhWdkYwWkFPRXJMUStZTElRZk5hNisiLCJtYWMiOiIwMTIwN2UxMWU5MGI4ZDViY2IwYjA0YzJjMzBkNzU0Mjk3OWNmOTZjMDg1NDExOTczMzZlNTI3OGU5M2U3YzYzIiwidGFnIjoiIn0%3D; expires=Mon, 16 Jun 2025 13:05:43 GMT; Max-Age=7200; path=/; samesite=lax; laravel_session=eyJpdiI6ImFMdWM3dDFraTdxN3FsTmFKekpaTUE9PSIsInZhbHVlIjoiZGx4Q2NtT3F3TjgrY0dVaEtoc1ZVMzVhOU5YY0gxZkVyOCt0elFtcGdOTFNWaEIvY0pWWTJuWWhEN2ZzQXRYYlE2QnhRVG9aQ2NVYU05Qnd3L2YzZ2Z1eVVJLzBFK3U1THFWUEhDL0pERytORENtUytrWXdMdjI1M1YvT0ZKaEIiLCJtYWMiOiI0NWJjYjcxN2ExYTM4NGNjNDNkMDlhNDIyMTE2Y2Q3OTcxYmUyODNmMGJhMGEyODZlZTFlMzU5YjRjMzc0YWUxIiwidGFnIjoiIn0%3D; expires=Mon, 16 Jun 2025 13:05:43 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-monthly-trends" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-monthly-trends"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-monthly-trends"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-monthly-trends" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-monthly-trends">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-monthly-trends" data-method="GET"
      data-path="api/monthly-trends"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-monthly-trends', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-monthly-trends"
                    onclick="tryItOut('GETapi-monthly-trends');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-monthly-trends"
                    onclick="cancelTryOut('GETapi-monthly-trends');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-monthly-trends"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/monthly-trends</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-monthly-trends"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-monthly-trends"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
