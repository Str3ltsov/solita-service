<?php

namespace App\Traits;

use App\Models\OrderFile;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

trait OrderFileServices
{
    public function createOrderFile(int $orderId, string $fileName, bool $isCommerceOffer = false): void
    {
        OrderFile::firstOrCreate([
            'order_id' => $orderId,
            'name' => $fileName,
            'location' => $isCommerceOffer ? "/documents/offers/$fileName" : "/documents/".$orderId."/".$fileName,
            'is_commerce_offer' => $isCommerceOffer,
            'created_at' => now()
        ]);
    }

    public function createDirForOrderFiles(string $path): void
    {
        if (!File::exists($path))
            File::makeDirectory($path, 0777, true);
    }

    public function createVatInvoice(object $order, string $orderPath): void
    {
        $fileName = "PVM Sąskaita-faktūra $order->id.pdf";

        if (!File::exists("$orderPath/$fileName")) {
            PDF::loadView('pdf.commerce_offer', [
                'order' => $order
            ])->save("$orderPath/$fileName");

            $this->createOrderFile($order->id, $fileName);
        }
    }

    public function createTACertificate(object $order, string $orderPath): void
    {
        $fileName = "Perdavimo-priėmimo Aktas $order->id.pdf";

        if (!File::exists("$orderPath/$fileName")) {
            PDF::loadView('pdf.ta_certificate', [
                'order' => $order,
                'customer' => $order->user
            ])->save("$orderPath/$fileName");

            $this->createOrderFile($order->id, $fileName);
        }
    }

    public function createEcommerceOffer(object $order, string $offersPath): void
    {
        $fileName = "Komercinis Pasiūlymas $order->id.pdf";

        $pdf = PDF::loadView('pdf.commerce_offer', [
            'order' => $order
        ]);
        $pdf->save("$offersPath/$fileName");

        $this->createOrderFile($order->id, $fileName, true);
    }

    public function deleteEcommerceOffer(int $orderId): void
    {
        File::delete(public_path()."/documents/offers/Komercinis Pasiūlymas $orderId.pdf");

        $orderFile = OrderFile::where('order_id', $orderId)
            ->where('is_commerce_offer', true)
            ->first();

        $orderFile && $orderFile->delete();
    }
}
