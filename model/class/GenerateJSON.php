<?php

class GenerateJSON
{
    private static ?GenerateJSON $instance = null;
    private string $filename;

    private function __construct()
    {
    }

    public static function getInstance(): GenerateJSON
    {
        if (self::$instance === null) {
            self::$instance = new GenerateJSON();
        }
        return self::$instance;
    }

    public function generate(array $datas): void
    {
        $username = $datas['user']['username'];
        $randint = rand(0, 1000000);
        $this->filename = $username . '-' . $randint . '.json';

        $json = json_encode($datas, JSON_PRETTY_PRINT);
        // On crée un fichier JSON vide pour le remplir
        $file = fopen(PATH_JSON . $this->filename, 'w');

        fwrite($file, $json);
        fclose($file);

        $this->header();
    }

    private function header(): void
    {
        // Vider le tampon de sortie pour supprimer l'HTML
        ob_clean();

        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="' . $this->filename . '"');
        readfile(PATH_JSON . $this->filename);

        $this->unlink();
    }

    private function unlink(): void
    {
        unlink(PATH_JSON . $this->filename);
    }
}
