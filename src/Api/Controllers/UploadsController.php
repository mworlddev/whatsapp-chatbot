<?php
namespace WhatsappChatbot\Api\Controllers;

use WhatsappChatbot\Api\Requests\FileUploadRequest;


class UploadsController
{
    public function store(FileUploadRequest $request)
    {
        $fileName = $request->file->getClientOriginalName();
        $filePath = $request->file->storeAs('public/uploads', $fileName);

        return response()->json([
            'success'       => true,
            'file_name'     => $fileName,
            'file_path'     => $filePath
        ]);
    }
}
