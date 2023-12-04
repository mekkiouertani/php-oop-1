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

    // Costruttore della classe Movie
    function __construct($id, $title, $overview, $vote, $image, $language)
    {
        // Inizializza le proprietà con i valori passati al costruttore
        $this->id = $id;
        $this->title = $title;
        $this->overview = $overview;
        $this->vote_average = $vote;
        $this->poster_path = $image;
        $this->original_language = $language;
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
    $movies[] = new Movie($item['id'], $item['title'], $item['overview'], $item['vote_average'], $item['poster_path'], $item['original_language']);
}
?>