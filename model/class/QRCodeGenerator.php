<?php

require_once(PATH_LIBRARIES . 'phpqrcode/qrlib.php');

class QRCodeGenerator
{
    private $qrCodePath;
    private $qrCodeName;
    private $qrCodeContent;

    public function __construct($id)
    {
        $this->qrCodePath = PATH_QRCODES;
        $this->qrCodeName = $id . '-' . uniqid() . '.png';
        $this->qrCodeContent = 'http://localhost/TimeChat/?page=profile&user=' . $id;
    }

    public function generateQRCode(): string
    {
        $qrCodePath = $this->qrCodePath . $this->qrCodeName;
        QRcode::png($this->qrCodeContent, $qrCodePath, QR_ECLEVEL_L, 30, 2);
        return $this->qrCodeName;
    }
}
