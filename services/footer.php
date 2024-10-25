<!-- footer.php -->
<footer class="footer">
    <div class="footer-container">

        <p>&copy; <?php echo date("Y"); ?> CDF. Tous droits réservés. Développé par 
            <a href="https://valentin-renaudin.com" target="_blank" style="color: white; text-decoration: underline;">
                Azrom
            </a>
        </p>

    </div>
</footer>
<style>
    @font-face {
    font-family: 'University';
    src: url('../assets/fonts/University.otf') format('opentype');
    font-weight: normal;
    font-style: normal;
}

@font-face {
    font-family: 'Tommy';
    src: url('../assets/fonts/tommy.otf') format('opentype');
    font-weight: normal;
    font-style: normal;
}

    /* footer.css */
.footer {
    font-family: 'Tommy', sans-serif;
    color: white;
    position: relative;
    width: 100%;
    bottom: 0;
    text-align: center;
}

.footer-container {
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}

.footer p {
    margin: 0;
    font-size: 0.9em;
    opacity: 0.8;
}





</style>