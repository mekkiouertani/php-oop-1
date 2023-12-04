<?php
class Movie
{
    // Attributi privati della classe Movie
    private int $id;
    private string $title;
    private string $overview;
    private string $vote_average;
    private string $poster_path;
    private string $original_language;
    private $genre_ids;

    // Costruttore della classe Movie
    function __construct($id, $title, $overview, $vote, $image, $language, $genre)
    {
        // Inizializza le proprietà con i valori passati al costruttore
        $this->id = $id;
        $this->title = $title;
        $this->overview = $overview;
        $this->vote_average = $vote;
        $this->poster_path = $image;
        $this->original_language = $language;
        $this->genre_ids = $genre;
    }

    // Metodo per ottenere la bandiera del paese
    public function getFlagApi()
    {
        $apiFlag = strtoupper(substr($this->original_language, 0, 2));

        if ($apiFlag === "EN") {
            $apiFlag = "GB";
        } elseif ($apiFlag === "JA") {
            $apiFlag = "JP";
        } elseif ($apiFlag === "DA") {
            $apiFlag = "CA";
        } elseif ($apiFlag === "ZH") {
            $apiFlag = "ES";
        } elseif ($apiFlag === "HI") {
            $apiFlag = "CL";
        }
        return $this->currentFlag = "https://flagsapi.com/" . $apiFlag . "/flat/64.png";
    }

    // Metodo per ottenere la rappresentazione visuale del voto
    public function getVote()
    {
        $vote = ceil($this->vote_average / 2);
        $template = "<p>";
        for ($n = 1; $n <= 5; $n++) {
            $template .= ($n <= $vote) ? '<i class="fa-solid fa-star"></i>' : '<i class="fa-regular fa-star"></i>';
        }
        $template .= "</p>";
        return $template;
    }

    // Metodo per stampare la card del film
    public function printCard()
    {
        // Ottieni i dati necessari e includi il file di visualizzazione
        $image = $this->poster_path;
        $title = $this->title;
        $content = substr($this->overview, 0, 100) . '...';
        $custom = $this->getVote();
        $language = $this->getFlagApi();
        $genre = $this->genre_ids;
        include __DIR__ . '/../Views/card.php';
    }

}

// Leggi il contenuto del file JSON che contiene i dati dei film
$movieString = file_get_contents(__DIR__ . '/db.json');
$movieList = json_decode($movieString, true);

// Inizializza un array vuoto per i film
$movies = [];

// Crea istanze della classe Movie per ogni elemento nella lista dei film
foreach ($movieList as $item) {
    $movies[] = new Movie($item['id'], $item['title'], $item['overview'], $item['vote_average'], $item['poster_path'], $item['original_language'], $item['genre_ids']);
}
?>