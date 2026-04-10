<?php 
    $pageTitle = "FAQs";
    $pageStyle = "supplements.css";
    include('header.php'); 
?>

        <section class = "page">
            <div class = "body-cover">
                <img src = "../images/faqs-cover.jpg">
            </div>

            <div class = "body-content">

                <div class = "title">
                    <h1>Frequently Asked<br>Questions</h1>
                    <div class = "faqs-image"><img src = "../images/faqs.png"></div>
                </div>

                <div class = "faqs-container">
                    <br><br><hr>

                    <div class = "faq-item">
                        <div class = "question">
                            <h3>What does it take for an attraction to be considered a "hidden gem"?</h3>
                            <button class = "expand">
                                <i class = "fa fa-plus"></i>
                            </button>
                        </div>
                        <div class = "answer">
                            <p>
                                This system uses a composite metric known as gem score to 
                                quantify the concept of "hidden gem-ness". Essentially, it is
                                a custom obscurity index where the higher the gem score, the
                                more an attraction has achieved a balance of being hidden and
                                being of good quality.
                            </p>
                            <p>
                                For more information on gem score, refer to the next inquiry.
                            </p>
                        </div>
                    <hr>
                    </div>
                    
                    <div class = "faq-item">
                        <div class = "question">
                            <h3>How is gem score calculated?</h3>
                            <button class = "expand">
                                <i class = "fa fa-plus"></i>
                            </button>
                        </div>
                        <div class = "answer">
                            <p>
                                Gem score is calculated using a weighted average that balances
                                two metrics: popularity (inverse), which uses the number of 
                                tourist visits obtained from cross-checking with an attraction's 
                                total accumulated visits, and quality, which bases off the average 
                                local rating.
                            </p>
                            <p>
                                Tourist visits have a greater impact on the outcome of the 
                                gem score with a 0.6 percentage, whereas quality accounts for
                                the remaining 40%.
                            </p>
                        </div>
                    <hr>
                    </div>

                    <div class = "faq-item">
                        <div class = "question">
                            <h3>Why are the attractions limited to Manila and Baguio?</h3>
                            <button class = "expand">
                                <i class = "fa fa-plus"></i>
                            </button>
                        </div>
                        <div class = "answer">
                            <p>
                                Though the concept would be more appropriate for a much wider 
                                scope like nationwide or international, as a student project, 
                                the scope of this system only covers attractions within selected 
                                locations. The developers (IT-PROGITITAS) used only Manila 
                                and Baguio, having proposed both in the pre-development phase.
                            </p>
                        </div>
                    <hr>
                    </div>

                </div>

            </div>
        </section>

        <script>
            document.querySelectorAll('.expand').forEach(button => 
            {
                button.addEventListener('click', () => {
                    const item = button.closest('.faq-item');
                    item.classList.toggle('active');
                });
            });
        </script>
    </body>
</html>