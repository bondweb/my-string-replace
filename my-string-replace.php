<?php

/*
 * Plugin Name: My string replace
 * Plugin URI:  https://example.com/plugins/the-basics/
 * Description: Questo pulg-in consente di cercare e sostuituri una stringa di testo all'interno dek contenuto del sito.
 * Version:     1.0
 * Author:      Mario B
 * Author URI:  https://author.example.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mystringreplace
 * Domain Path: /languages
 */


// Creo la voce di menù e la pagina opzioni
function mystringreplace_register_options_page(){
  add_menu_page('Plugin cerca e sostituisci', 'Cerca e Sostitusici', 'administrator', 'mystringreplace', 'mystringreplace_options_page');
}
add_action('admin_menu', 'mystringreplace_register_options_page');


// Registro le opziopni del plug-in nella pagina

function mystringreplace_register_settings(){
   add_option('mystringreplace_option_name_search', 'Scrivi qui il testo da cercare');
   add_option('mystringreplace_option_name_replace', 'Scrivi qui il testo con cui sostituire');
   register_setting('mystringreplace_options_group', 'mystringreplace_option_name_search', 'mystringreplace_callback');
   register_setting('mystringreplace_options_group', 'mystringreplace_option_name_replace', 'mystringreplace_callback');
}
add_action('admin_init', 'mystringreplace_register_settings');


// Visualizzo le opzioni nella Pagina
function mystringreplace_options_page(){
?>
  <div>

  <h2>Aggiungi il testo che vuoi correggere</h2>
  <form method="post" action="options.php">
  <?php settings_fields('mystringreplace_options_group'); ?>
  <p>Inserisci il testo da cercare e sostituire nei campi sottostanti</p>
  <table>
  <tr valign="top">
  <th scope="row"><label for="mystringreplace_option_name_search">Cerca</label></th>
  <td><input type="text" id="mystringreplace_option_name_search" name="mystringreplace_option_name_search" value="<?php echo get_option('mystringreplace_option_name_search'); ?>" /></td>
  </tr>
  <tr valign="top">
  <th scope="row"><label for="mystringreplace_option_name_replace">Sostituisci</label></th>
  <td><input type="text" id="mystringreplace_option_name_replace" name="mystringreplace_option_name_replace" value="<?php echo get_option('mystringreplace_option_name_replace'); ?>" /></td>
  </tr>
  </table>
  <?php submit_button();?>
  </form>
  </div>
<?php
}?>
<?php
// Aggancio the 'the_content & the_title' con un filtro, aggiungendo la funzione 'mystringreplace_to_content'
add_filter("the_content", "mystringreplace_to_content");
add_filter("the_title", "mystringreplace_to_content");

function mystringreplace_to_content($ciccio){
	$search = get_option('mystringreplace_option_name_search');
	$replace = get_option('mystringreplace_option_name_replace');
	return str_replace($search, $replace, $ciccio);
}?>
