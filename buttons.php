<?
include_once("bootstrap.inc.php");

class PouetBoxButtons extends PouetBox {
  function PouetBoxButtons() {
    parent::__construct();
    $this->uniqueID = "pouetbox_buttons";
  }

  function LoadFromDB()
  {
    // Get all the buttons ordered by type of buttons, randomly within each type
    $this->buttons = SQLLib::SelectRows("SELECT type, url, img, alt FROM buttons WHERE dead = 0 ORDER BY type ASC, RAND()");
  }
  function Render()
  {
    echo "\n\n";
    echo "<div class='pouettbl' id='".$this->uniqueID."'>\n";
    $type = "";
    foreach($this->buttons as $b)
    {
      if ($type != $b->type)
      {
        if($type)
        {
          echo "</ul>\n";
          echo "</div>\n";
        }
        echo "<h2>"._html($b->type)."</h2>\n";
        echo "<div class='content'>\n";
        echo "<ul>\n";
        $type = $b->type;
      }
      echo "  <li><a href='"._html($b->url)."'><img src='".POUET_CONTENT_URL."/gfx/buttons/".$b->img."' title='"._html($b->alt)."' alt='"._html($b->alt)."'/></a></li>\n";
    }
    echo "</ul>\n";
    echo "</div>\n";
    echo "</div>\n";
  }
};

$TITLE = "we like !";

include("include_pouet/header.php");
include("include_pouet/menu.inc.php");

echo "<div id='content'>\n";

$box = new PouetBoxButtons();
$box->Load();
$box->Render();

echo "</div>\n";

include("include_pouet/menu.inc.php");
include("include_pouet/footer.php");

?>
