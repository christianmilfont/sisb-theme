<?php
/**
 * Sitemap das páginas virtuais.
 *
 * O WordPress gera wp-sitemap.xml a partir de posts e taxonomias. As páginas
 * de módulo e as institucionais não são posts, então nenhuma delas apareceria.
 * Este provedor as acrescenta ao sitemap nativo — sem plugin.
 *
 * @package SISB
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Registra o provedor de sitemap das rotas virtuais do tema.
 */
function sisb_register_sitemap_provider() {
    if ( ! class_exists( 'WP_Sitemaps_Provider' ) ) {
        return;
    }

    /**
     * Provedor das URLs virtuais: índice de módulos, módulos e páginas
     * institucionais.
     */
    class SISB_Sitemap_Provider extends WP_Sitemaps_Provider {

        public function __construct() {
            $this->name        = 'sisb';
            $this->object_type = 'sisb';
        }

        /**
         * @param int    $page_num
         * @param string $object_subtype
         * @return array<int,array{loc:string}>
         */
        public function get_url_list( $page_num, $object_subtype = '' ) {
            $urls = array(
                array( 'loc' => sisb_modules_url() ),
            );

            foreach ( array_keys( sisb_get_modules() ) as $slug ) {
                $urls[] = array( 'loc' => sisb_module_url( $slug ) );
            }

            foreach ( array_keys( sisb_get_static_pages() ) as $slug ) {
                $urls[] = array( 'loc' => sisb_static_page_url( $slug ) );
            }

            /**
             * Permite ajustar as URLs virtuais publicadas no sitemap.
             *
             * @param array $urls
             */
            return apply_filters( 'sisb_sitemap_urls', $urls );
        }

        /**
         * Todas as URLs cabem em uma página — são poucas dezenas.
         *
         * @param string $object_subtype
         * @return int
         */
        public function get_max_num_pages( $object_subtype = '' ) {
            return 1;
        }
    }

    wp_register_sitemap_provider( 'sisb', new SISB_Sitemap_Provider() );
}
add_action( 'init', 'sisb_register_sitemap_provider', 30 );
