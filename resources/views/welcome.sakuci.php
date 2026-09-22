@extends('layouts.app')

@section('title', config('app.name') . ' -- Kerangka PHP Ringan')

@section('content')

    {{-- Hero --}}
    <section class="text-left py-4 py-lg-5">
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">Sakuci v1.0.0</span>

        <h1 class="display-5 fw-bold mb-3">
            Web Peminjaman Alat Sekolah,<br class="d-none d-md-inline">
            <span class="text-brand">GoPENA(Peminjaman Inventaris Alat)</span>
        </h1>

        <p class="lead text-secondary mx-auto mb-4" style="max-width: 1200px;">
            Sistem Peminjaman & Inventaris Alat Modern (GoPENA).
        </p>

        <div class="d-flex flex-wrap gap-2 justify-content-left">
            <a class="btn btn-brand btn-lg px-4" href="{{ route('login') }}">Login</a>
            <a class="btn btn-outline-brand btn-lg px-4" href="https://github.com/indrabsus/sakuci-framework" target="_blank">GitHub</a>
        </div>

        <p class="text-secondary small mt-3 mb-0">
            Panduan langkah demi langkah ada di berkas
            <code class="inline">TUTORIAL.md</code>
        </p>
    </section>

    {{-- Empat pilar --}}
    <section>
        <h2 class="h5 fw-semibold mb-3">Empat pilar</h2>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-body border-0 pt-3 pb-0">
                        <span class="fw-semibold">Route</span>
                        <span class="text-secondary small ms-1">routes/web.php</span>
                    </div>
                    <div class="card-body">
                        <pre class="code">Route::get('/buku',
    [BukuController::class, 'index'])
    ->name('buku.index');

<span class="cmt">// 7 route CRUD sekaligus</span>
Route::resource('buku',
    BukuController::class);</pre>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-body border-0 pt-3 pb-0">
                        <span class="fw-semibold">Controller</span>
                        <span class="text-secondary small ms-1">app/Controllers</span>
                    </div>
                    <div class="card-body">
                        <pre class="code">class BukuController extends Controller
{
    public function index()
    {
        return view('buku.index', [
            'buku' => Buku::all(),
        ]);
    }
}</pre>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-body border-0 pt-3 pb-0">
                        <span class="fw-semibold">Model</span>
                        <span class="text-secondary small ms-1">app/Models</span>
                    </div>
                    <div class="card-body">
                        <pre class="code">Buku::all();
Buku::find(1);
Buku::where('stok', '>', 0)
    ->latest()
    ->paginate(10);

Buku::create(['judul' => 'PHP']);</pre>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-body border-0 pt-3 pb-0">
                        <span class="fw-semibold">View</span>
                        <span class="text-secondary small ms-1">resources/views</span>
                    </div>
                    <div class="card-body">
                        <pre class="code">@@extends('layouts.app')

@@section('content')
    @@foreach ($buku as $b)
        &lt;h2&gt;&#123;&#123; $b-&gt;judul &#125;&#125;&lt;/h2&gt;
    @@endforeach
@@endsection</pre>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
