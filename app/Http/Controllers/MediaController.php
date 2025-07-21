<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;

class MediaController extends Controller
{
    use HttpResponses;

    public function index(Request $request): JsonResponse
    {
        $search = $request->input('search');
        $paginate = $request->input('length', 10);
        $notUsed = $request->input('not_used', 0);
        if ($notUsed) {
            $data = Media::leftJoin('mediable', 'media.id', '=', 'mediable.media_id')
                ->whereNull('mediable.media_id')
                ->when($search, function ($query) use ($search) {
                    $query->where('media.name', 'like', "%$search%");
                })
                ->select('media.*')
                ->orderBy('media.id', 'asc')
                ->paginate($paginate);
        } else {
            if ($request->filled('ids')) {
                $data = Media::whereIn('id', $request->get('ids', []))->get();
            } else {
                $data = Media::when($search, function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                })
                    ->orderBy('id', 'asc')
                    ->paginate($paginate);
            }
        }
        $dataResource = MediaResource::collection($data)->withQueryString();
        return $this->success($dataResource, 'Data has been fetched successfully');
    }

    public function show(Media $media): JsonResponse
    {
        return $this->success(new MediaResource($media), 'Item fetched successfully');
    }

    public function showMedia(Request $request): AnonymousResourceCollection
    {
        $imageIds = $request->input('images', []);
        $media = Media::whereIn('id', $imageIds)->get();
        return MediaResource::collection($media);
    }

    public function store(Request $request): JsonResponse
    {
        $author_id = Auth::check() ? Auth::user()->id : null;
        try {
            $file = request()?->file('file');

            [$storedFile, $fileName, $finalFilePath] = $this->uploadFile($file);

            $media = Media::create([
                'name' => $fileName,
                'file_name' => $fileName,
                'mime_type' => $storedFile->getMimeType(),
                'size' => filesize($storedFile),
                'author_id' => $author_id,
                'file_path' => $finalFilePath,
            ]);
            return $this->success(new MediaResource($media), 'Item fetched successfully');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['message' => $exception->getMessage()], 422);
        }
    }

    private function uploadFile($storedFile): array
    {
        $originalName = $storedFile->getClientOriginalName();
        $fileName = pathinfo($originalName, PATHINFO_FILENAME);
        $base_directory = "media";
        $directory = request('directory') ?: "files";
        $unique_code = Str::uuid(); // Generate a unique code
        $file_name = Str::slug($fileName) . '-' . $unique_code;
        $file_path_directory = $base_directory . '/' . $directory;
        $fileExtension = pathinfo($originalName, PATHINFO_EXTENSION);
        $finalFilePath = $file_path_directory . '/' . $file_name . '.' . $fileExtension;
        $storedFile->storeAs($file_path_directory, $file_name . '.' . $fileExtension, 'public');

        return [$storedFile, $fileName, $finalFilePath];
    }

    public function storeMany(Request $request): JsonResponse
    {
        $author_id = Auth::check() ? Auth::user()->id : null;
        try {
            $files = request()?->file('files') ?? [];
            $uploadedMedia = [];
            foreach ($files as $file) {
                [$storedFile, $fileName, $finalFilePath] = $this->uploadFile($file);
                $media = Media::create([
                    'name' => $fileName,
                    'file_name' => $fileName,
                    'mime_type' => $storedFile->getMimeType(),
                    'size' => filesize($storedFile),
                    'author_id' => $author_id,
                    'file_path' => $finalFilePath,
                ]);

                $uploadedMedia[] = new MediaResource($media);
            }


            return $this->success(MediaResource::collection($uploadedMedia), 'Items fetched successfully');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['message' => $exception->getMessage()], 422);
        }
    }

    public function destroy(Media $media): JsonResponse
    {
        $media->delete();
        Storage::disk('public')->delete($media->path);
        return $this->success(null, 'Item deleted successfully');
    }

    public function getUnUsedImages(): JsonResponse
    {
        $images = Media::whereNotIn('id', static function ($query) {
            $query->select('media_id')->from('mediable');
        })->get();
        $unUsedImages = MediaResource::collection($images);
        return $this->success($unUsedImages, 'Data has been fetched successfully');
    }

    public function deleteUnUsedImages(): JsonResponse
    {
        $images = Media::whereNotIn('id', static function ($query) {
            $query->select('media_id')->from('mediable');
        })->get();
        $imagesCount = $images->count();
        if ($imagesCount > 0) {
            foreach ($images as $media) {
                $media->delete();
                Storage::disk('public')->delete($media->path);
                if (Str::contains($media->mime_type, 'image')) {
                    Storage::disk('public')->delete($media->preview_url);
                }
            }
        } else {
            return $this->success(null, 'Hurray! All images is attached to something...');
        }
        return $this->success(null, $imagesCount . ' image(s) has been deleted successfully');
    }



    public function deleteImagesByIds(Request $request): JsonResponse
    {
        $ids = $request->input('ids');

        if (!is_array($ids) || empty($ids)) {
            return $this->error('Please provide a valid array of IDs.');
        }

        $images = Media::whereIn('id', $ids)->get();

        foreach ($images as $media) {
            $hasRelation = DB::table('mediable')->where('media_id', $media->id)->exists();
            if ($hasRelation) {
                return $this->error("Cannot delete the image with ID {$media->id} because it is associated with other items.");
            }
        }

        $deletedCount = 0;
        foreach ($images as $media) {
            $media->delete();
            Storage::disk('public')->delete($media->path);
            if (Str::contains($media->mime_type, 'image')) {
                Storage::disk('public')->delete($media->preview_url);
            }
            $deletedCount++;
        }

        return $this->success(null, "$deletedCount image(s) have been successfully deleted.");
    }

}
