<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLOUDedge Tech Services — Technology Solutions That Drive Business Growth</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,700;1,300&family=DM+Mono:wght@400;500&family=Playfair+Display:wght@700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="animation.css">
</head>

<body>

    <div class="cursor" id="cursor"></div>
    <div class="cursor-ring" id="cursorRing"></div>

    <!-- NAV -->
    <nav id="navbar">
        <a href="#home" class="logo">CLOUD<span>edge</span></a>
        <ul class="nav-links" id="navLinks">
            <li><a href="#home">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#joinus">Join Us</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#contact" class="nav-cta">Get Started</a></li>
        </ul>
        <div class="theme-toggle" id="themeToggle"></div>
        <div class="nav-toggle" id="navToggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>

    <!-- HERO -->
    <section id="home" class="hero">
        <div class="hero-bg"></div>
        <div class="hero-grid-lines"></div>
        <div class="hero-inner">
            <div class="hero-left">
                <div class="hero-eyebrow">
                    <span class="eyebrow-line"></span>
                    <span class="eyebrow-text">Managed Service Provider</span>
                </div>
                <h1 class="hero-title">
                    <div class="line"><span>Technology</span></div>
                    <div class="line"><span>Solutions</span></div>
                    <div class="line"><span class="outline">That Drive</span></div>
                    <div class="line"><span>Growth</span></div>
                </h1>
                <p class="hero-desc">
                    Transform your business with cutting-edge IT solutions, cybersecurity, and digital transformation
                    services. We help modern enterprises scale efficiently and securely.
                </p>
                <div class="hero-actions">
                    <a href="#contact" class="btn-main">Apply Now <i class="fas fa-arrow-right"></i></a>
                    <a href="schedule.php" class="btn-ghost">Schedule A Call <i class="fas fa-calendar"></i></a>
                </div>
            </div>
            <div class="hero-right">
                <div class="hero-stats-vertical">
                    <div class="stat-row">
                        <div class="stat-num" id="stat1">0<span class="plus">+</span></div>
                        <div class="stat-meta">
                            <span class="stat-lbl">Clients Served</span>
                            <span class="stat-sub">Across 12 Industries</span>
                        </div>
                    </div>
                    <div class="stat-row">
                        <div class="stat-num" id="stat2">0<span class="plus">%</span></div>
                        <div class="stat-meta">
                            <span class="stat-lbl">Uptime Guarantee</span>
                            <span class="stat-sub">SLA Backed</span>
                        </div>
                    </div>
                    <div class="stat-row">
                        <div class="stat-num" id="stat3">0<span class="plus">+</span></div>
                        <div class="stat-meta">
                            <span class="stat-lbl">Years Experience</span>
                            <span class="stat-sub">Since 2023</span>
                        </div>
                    </div>
                </div>
                <div class="hero-ticker">
                    <div class="ticker-item"><span class="ticker-dot"></span> Available 24/7</div>
                    <div class="ticker-item"><span class="ticker-dot"></span> SOC 2 Compliant</div>
                    <div class="ticker-item"><span class="ticker-dot"></span> HIPAA Ready</div>
                    <div class="ticker-item"><span class="ticker-dot"></span> ISO 27001</div>
                </div>
            </div>
        </div>
        <div class="scroll-hint">
            <div class="scroll-line"></div>
            <span class="scroll-text"></span>
        </div>
    </section>

    <!-- MARQUEE -->
    <div class="marquee-strip" aria-hidden="true">
        <div class="marquee-track" id="marqueeTrack">
            <div class="marquee-item">Backup & Recovery <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">IT Consulting <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Cloud Infrastructure <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Cybersecurity Solutions <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Managed IT Services <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Backup & Recovery <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">IT Consulting <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Cloud Infrastructure <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Cybersecurity Solutions <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Managed IT Services <span class="marquee-sep">✦</span></div>
        </div>
    </div>



    <!-- SERVICES -->
    <section id="services" class="services">
        <div class="services-inner">
            <div class="section-header reveal">
                <div class="section-title-wrap">
                    <div class="section-tag">What We Offer</div>
                    <h2>Comprehensive<br>IT Solutions</h2>
                </div>
                <div class="section-desc-wrap">
                    <p>CLOUDedge Tech Services delivers practical, high-impact solutions tailored for today's business
                        and tech needs.</p>
                </div>
            </div>

            <div class="services-grid">
                <div class="service-card reveal reveal-delay-1">
                    <div class="card-icon"><i class="fas fa-brain"></i></div>
                    <h3 class="card-title">AI & Technology Solutions</h3>
                    <p class="card-desc">Our AI and technology solutions empower organizations with automation, data
                        insights, and intelligent systems that enhance efficiency, innovation, and competitive
                        advantage.</p>
                    <a href="#contact" class="card-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="service-card reveal reveal-delay-2">
                    <div class="card-icon"><i class="fas fa-laptop-code"></i></div>
                    <h3 class="card-title">SaaS Development & Consulting</h3>
                    <p class="card-desc">We specialize in SaaS development and consulting, delivering scalable cloud
                        platforms that streamline processes, boost productivity, and accelerate business transformation.
                    </p>
                    <a href="#contact" class="card-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="service-card reveal reveal-delay-3">
                    <div class="card-icon"><i class="fas fa-headset"></i></div>
                    <h3 class="card-title">International Call Centers</h3>
                    <p class="card-desc">Delivering customer support that builds trust and drives growth. Our inbound
                        and outbound call center solutions are designed to help businesses strengthen customer
                        relationships, increase sales, and expand into global markets.</p>
                    <a href="#contact" class="card-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="service-card reveal reveal-delay-1">
                    <div class="card-icon"><i class="fas fa-users"></i></div>
                    <h3 class="card-title">Recruitment & Staffing Solutions</h3>
                    <p class="card-desc">We provide customized recruitment and staffing solutions, connecting businesses
                        with skilled professionals who drive performance, culture fit, and long-term success.</p>
                    <a href="#contact" class="card-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="service-card reveal reveal-delay-2">
                    <div class="card-icon"><i class="fas fa-bullhorn"></i></div>
                    <h3 class="card-title">Digital Marketing Services</h3>
                    <p class="card-desc">We design impactful digital marketing strategies with SEO, WordPress solutions,
                        and SMM to strengthen brand presence, engage audiences, and maximize business growth across
                        online platforms.</p>
                    <a href="#contact" class="card-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="service-card reveal reveal-delay-3">
                    <div class="card-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <h3 class="card-title">IT Training & Mentorship</h3>
                    <p class="card-desc">We offer hands-on IT training and mentorship that develops practical expertise,
                        career confidence, and guidance to succeed in today's dynamic technology landscape.</p>
                    <a href="#contact" class="card-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
                <!-- Row 3: filler | card | filler -->
                <div class="services-grid__filler"></div>
                <div class="service-card service-card--center reveal reveal-delay-1">
                    <div class="card-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3 class="card-title">Manage IT Services & Cybersecurity Services</h3>
                    <p class="card-desc">Keep your business secure, resilient, and always online. Our IT and
                        cybersecurity services are designed to protect your infrastructure, minimize downtime, and
                        safeguard sensitive data.</p>
                    <a href="#contact" class="card-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="services-grid__filler"></div>
            </div>
        </div>
    </section>

    <!-- JOIN US -->
    <section id="joinus" class="joinus">
        <div class="joinus-bg"></div>
        <div class="joinus-inner reveal">
            <div class="joinus-badge">Careers</div>
            <h2 class="joinus-title">Join Us</h2>
            <div class="joinus-divider"></div>
            <p class="joinus-text">
                At CLOUDedge Tech Services, we don't just offer jobs — we create opportunities to shape your future.
                Whether you are a fresher ready to begin your career journey or an experienced professional aiming for
                new heights, we provide a platform that matches your ambition and talent. Our focus is on practical
                learning, real-time project exposure, and continuous skill development. We nurture innovation, encourage
                creativity, and support growth through strong mentorship and teamwork. Become a part of a dynamic team
                that is transforming IT, digital solutions, and staffing services with passion and purpose.
            </p>
            <div class="joinus-features">
                <div class="joinus-feat">
                    <div class="feat-icon"><i class="fas fa-rocket"></i></div>
                    <span>Career Growth</span>
                </div>
                <div class="joinus-feat">
                    <div class="feat-icon"><i class="fas fa-lightbulb"></i></div>
                    <span>Innovation Culture</span>
                </div>
                <div class="joinus-feat">
                    <div class="feat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <span>Strong Mentorship</span>
                </div>
                <div class="joinus-feat">
                    <div class="feat-icon"><i class="fas fa-project-diagram"></i></div>
                    <span>Real-Time Projects</span>
                </div>
            </div>
            <a href="#contact" class="btn-main joinus-cta">Apply Now <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="faq">
        <div class="faq-inner">
            <div class="section-header reveal">
                <div class="section-title-wrap">
                    <div class="section-tag">FAQ</div>
                    <h2>Answers You<br>Need Fast</h2>
                </div>
                <div class="section-desc-wrap">
                    <p>Everything you need to know before starting with CLOUDedge Tech Services, from onboarding to
                        security and support coverage.</p>
                </div>
            </div>

            <div class="faq-list reveal" id="faqList">
                <article class="faq-item active">
                    <button class="faq-question" type="button" aria-expanded="true">
                        <span>What services does CLOUDedge provide?</span>
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="faq-answer">
                        <p>We provide AI and technology solutions, SaaS development and consulting, managed IT services,
                            cybersecurity, recruitment and staffing, digital marketing, international call center
                            support,
                            and IT training with mentorship.</p>
                    </div>
                </article>

                <article class="faq-item">
                    <button class="faq-question" type="button" aria-expanded="false">
                        <span>Do you work with startups, SMBs, and enterprise clients?</span>
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Yes. We work with early-stage startups, growing SMBs, and enterprise teams. Our engagement
                            model is tailored to your scale, priorities, and budget.</p>
                    </div>
                </article>

                <article class="faq-item">
                    <button class="faq-question" type="button" aria-expanded="false">
                        <span>How quickly can your team start a project?</span>
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Most projects start within 3 to 7 business days after discovery. For urgent IT support and
                            cybersecurity incidents, we can start triage the same day.</p>
                    </div>
                </article>

                <article class="faq-item">
                    <button class="faq-question" type="button" aria-expanded="false">
                        <span>Can you provide dedicated staffing and remote teams?</span>
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Absolutely. We provide recruitment and staffing support for technical and non-technical
                            roles,
                            including dedicated remote teams aligned with your business goals.</p>
                    </div>
                </article>

                <article class="faq-item">
                    <button class="faq-question" type="button" aria-expanded="false">
                        <span>How do we get started with CLOUDedge?</span>
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="faq-answer">
                        <p>You can send us a message through the contact form or book a call from the Schedule page.
                            We will discuss your needs, define scope, and share a clear action plan with next steps.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="contact">
        <div class="contact-inner reveal">
            <!-- LEFT -->
            <div class="contact-left">
                <div>
                    <div class="contact-eyebrow"><span>Get In Touch</span></div>
                    <h2 class="contact-title">Ready to<br>Transform<br>Your Business?</h2>
                </div>
                <p class="contact-desc">
                    Let's discuss how our technology solutions can help your business grow, scale, and stay secure.
                </p>
                <div class="info-list">
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <div class="info-label">Office</div>
                            <div class="info-value">123 Business Avenue<br>Technology Park, TP 12345</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <div class="info-label">Phone</div>
                            <div class="info-value"><a href="tel:+15551234567">+1 (430) 837-4007</a></div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <div class="info-label">Email</div>
                            <div class="info-value"><a href="mailto:andrew@cloudedge.com">andrew@cloudedge.com</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT — FORM -->
            <div class="contact-right">
                <div class="form-heading">
                    <h3>Send Us a Message</h3>
                    <p>We'll get back to you within 1 business day.</p>
                </div>

                <!-- ✅ Form action = contact.php (MySQL se connected) -->
                <form class="contact-form" id="contactForm" action="contact.php" method="POST" novalidate>
                    <div class="form-row">
                        <div class="field">
                            <label>Full Name <span class="req">*</span></label>
                            <input type="text" name="name" id="name" placeholder="John Smith" autocomplete="name">
                            <span class="field-error" id="nameErr"></span>
                        </div>
                        <div class="field">
                            <label>Email Address <span class="req">*</span></label>
                            <input type="email" name="email" id="email" placeholder="john@company.com"
                                autocomplete="email">
                            <span class="field-error" id="emailErr"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="field">
                            <label>Company</label>
                            <input type="text" name="company" placeholder="Your Company" autocomplete="organization">
                        </div>
                        <div class="field">
                            <label>Phone</label>
                            <input type="tel" name="phone" placeholder="+1 (555) 000-0000" autocomplete="tel">
                        </div>
                    </div>

                    <div class="field full">
                        <label>Message <span class="req">*</span></label>
                        <textarea name="message" id="message"
                            placeholder="Tell us about your business needs, current challenges, or what you're looking to achieve…"
                            maxlength="600" oninput="updateCount(this)"></textarea>
                        <span class="field-hint" id="charCount">0 / 600</span>
                        <span class="field-error" id="messageErr"></span>
                    </div>
                    <div class="checkbox-row">
                        <input type="checkbox" id="agree" name="agree">
                        <label for="agree">
                            I agree to CLOUDedge's <a href="#">Privacy Policy</a> and consent to being contacted about
                            relevant services.
                        </label>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="submit-btn" id="submitBtn">
                            Send Message <i class="fas fa-paper-plane"></i>
                        </button>
                        <span class="secure-note">
                            <i class="fas fa-lock"></i> Secured &amp; encrypted
                        </span>
                    </div>
                    <div class="form-message" id="formMessage">
                        <i class="fas fa-circle-check"></i>
                        Message sent — we'll be in touch within 1 business day.
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-top">
            <div class="footer-brand">
                <a href="#home" class="footer-logo">CLOUD<span>edge</span></a>
                <p>Leading managed service provider delivering innovative IT solutions for modern businesses that want
                    to scale with confidence.</p>
            </div>

            <div class="footer-col">
                <h5>Company</h5>
                <ul>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 CLOUDedge Tech Services. All rights reserved.</p>
            <div class="footer-bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </footer>
    <script src="main.js"></script>
</body>

</html>