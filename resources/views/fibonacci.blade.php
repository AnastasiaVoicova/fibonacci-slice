<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fibonacci slice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
</head>
<body>
    <section class="container-fluid">
        <form method="GET" action="{{ route('fibonacci.slice') }}">
            @csrf

            <div class="form-group mb-2">
                <label>From</label>
                <input type="text" class="form-control @error('from') is-invalid @enderror" name="from" id="from">
                @error('from')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label>To</label>
                <input type="text" class="form-control @error('from') is-invalid @enderror" name="to" id="to">
                @error('to')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="d-grid mt-3">
                <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
            </div>
        </form>

        @if(!empty($data))
        <br>
        <div>
            <label>Result</label>
            <input type="text" class="form-control" value="{{ implode(',', $data) }}" disabled>
        </div>
        @endif

    </section>
</body>
