    
    <footer class="footer">    
        <div class="footer-block wide-row">
            <?php if ( is_active_sidebar( 'footer-one' ) ) : ?>
                <div id="footer_one" class="sidebar widget-area" role="complementary">
                    
                    <?php dynamic_sidebar( 'footer-one' ); ?>
                
                </div>
            <?php else: ?>
            <div class="empty-div"></div>
            <?php endif; ?>
        </div>
        
        <div id="footerCopy" class="footer-block wide-row">
                <div class="copyright-footing"> 
                    <p>&copy; 2023 <a href="#topHeader">[Top]</a></p>
                </div>
            </div>
    </footer>
</div>
    <?php wp_footer(); ?>

</body>
</html>