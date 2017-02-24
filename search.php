$args = array (
  'post_type' => 'post',
  'ignore_sticky_posts' => true,
  'substring_where' => 't',
);

function restrict_by_first_letter( $where, $qry ) {
  global $wpdb;
  $sub = $qry->get('substring_where');
  if (!empty($sub)) {
    $where .= $wpdb->prepare(
      " AND SUBSTRING( {$wpdb->posts}.post_title, 1, 1 ) = %s ",
      $sub
    );

//  $where .= $wpdb->prepare(
//    " AND {$wpdb->posts}.post_title LIKE %s ",
//    $sub.'%'
//  );
  }
  return $where;
}
add_filter( 'posts_where' , 'restrict_by_first_letter', 1 , 2 );

$results = new WP_Query( $args );

var_dump($results->request); // debug
var_dump(wp_list_pluck($results->posts,'post_title')); // debug
