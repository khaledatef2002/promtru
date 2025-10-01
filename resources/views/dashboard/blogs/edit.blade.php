@extends('dashboard.layouts.app')

@section('title', __('dashboard.blogs.edit'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-sm-auto ms-auto">
                <a href="{{ route('dashboard.blogs.index') }}"><button class="btn btn-light"><i class="ri-arrow-go-forward-fill me-1 align-bottom"></i> @lang('dashboard.return')</button></a>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>
<form id="edit-blogs-form" data-id="{{ $blog->id }}">
    <div class="d-flex gap-4">
        <div class="col-md-8">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="gap-2 mb-3 flex-fill">
                            <label for="title">@lang('dashboard.title')</label>
                            <input id="title" type="text" class="form-control" name="title" value="{{ $blog->title }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="description">@lang('dashboard.description')</label>
                            <textarea id="description" name="description" class="form-control" placeholder="@lang('news.description')" height="500">{{ $blog->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-fill">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="text-center">
                            <p class="mb-0 fw-bold">@lang('dashboard.cover')</p>
                            <div class="position-relative d-inline-block auto-image-show">
                                <div class="position-absolute top-100 start-100 translate-middle">
                                    <label for="cover" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                <i class="ri-image-fill"></i>
                                            </div>
                                        </div>
                                    </label>
                                    <input class="form-control d-none" name="cover" id="cover" type="file" accept="image/png, image/gif, image/jpeg, image/webp">
                                </div>
                                <div class="avatar-lg" style="width: 12rem !important;">
                                    <div class="avatar-title bg-light rounded">
                                        <img src="{{ $blog->display_image }}" id="product-img" style="min-height: 100%;min-width: 100%;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="keywords">@lang('dashboard.keywords')</label>
                        <input id="keywords" type="text" class="form-control" name="keywords" value="{{ $blog->keywords }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-success w-sm loader-btn ms-auto">
                <p class="mb-0">@lang('dashboard.save')</p>
                <div class="loader"></div>
            </button>
        </div>
    </div>
</form>

@endsection

@section('additional-js-libs')
    

@endsection

@section('custom-js')
    <script src="{{ asset('back/js/blog-module.js') }}" type="module"></script>
    <script>
        const direction = document.body.getAttribute('dir');
        const input = document.querySelector('input[name=keywords]');
        const choices = new Choices(input, {
            removeItems: true,
            removeItemButton: true,
            removeItemButtonAlignLeft: direction,
            loadingText: '@lang("front.loading")...',
            noResultsText: '@lang("front.no-results")',
            noChoicesText: '@lang("front.no-choices")',
            itemSelectText: '@lang("front.item-select")',
            uniqueItemText: '@lang("front.unique-item")',
            placeholderValue: '@lang("front.placeholder-value")',
        });

        let images = [
            @foreach ($blog->images as $image)
                {
                    url: "{{ $image->path }}",
                    id: {{ $image->id }},
                },
            @endforeach
        ];

        let ckEditor
        ClassicEditor.create(document.querySelector('textarea#description'), {
            ckfinder: {
                uploadUrl: '/dashboard/ckEditorUploadImage?command=QuickUpload&type=Images&responseType=json'
            },
            mediaEmbed: {
                previewsInData: true,
                providers: [
                    {
                        name: 'youtube',
                        url: [
                            /^youtube\.com\/watch\?v=([\w-]+)/,
                            /^youtu\.be\/([\w-]+)/
                        ],
                        html: match => (
                            `<div style="position: relative; padding-bottom: 56.25%; height: 0;">
                                <iframe src="https://www.youtube.com/embed/${match[1]}" alt="khaled"
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" 
                                        frameborder="0" allowfullscreen></iframe>
                            </div>`
                        )
                    }
                ]
            }
        }).then(editor => {
            ckEditor = editor;
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return {
                    upload: () => {
                        return loader.file
                            .then(file => new Promise((resolve, reject) => {
                                const formData = new FormData();
                                formData.append('upload', file);

                                fetch('/dashboard/ckEditorUploadImage', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                    },
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    images.push({
                                        url: data.url,
                                        id: data.id
                                    })
                                    resolve({ default: data.url })
                                })
                                .catch(error => reject(error));
                            }));
                    }
                };
            };
            editor.model.document.on('change:data', () => {
                const currentImagesUrl = getImageSources(editor.getData());
                images = images.filter(img => currentImagesUrl.includes(img.url));
            });
        })
        .catch(error => {
            console.error(error);
        });

        function getImageSources(html) {
            const doc = new DOMParser().parseFromString(html, 'text/html');
            return Array.from(doc.querySelectorAll('img')).map(img => img.getAttribute('src'));
        }
    </script>
@endsection