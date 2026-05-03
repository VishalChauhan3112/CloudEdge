<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        (function () {
            try {
                var theme = localStorage.getItem('ce-theme');
                if (theme === 'day') {
                    document.documentElement.setAttribute('data-theme', 'day');
                } else {
                    document.documentElement.removeAttribute('data-theme');
                }
            } catch (e) { }
        })();
    </script>
    <title>About Us — CLOUDedge Tech Services</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,700;1,300&family=DM+Mono:wght@400;500&family=Playfair+Display:wght@700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="animation.css">
    <style>
        /* ABOUT PAGE STYLES */
        .about-hero {
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            padding-top: 80px;
            display: flex;
            align-items: center;
            background: var(--bg);
        }

        .about-hero-bg {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 55% 60% at 75% 25%, rgba(59, 130, 246, 0.09) 0%, transparent 65%), radial-gradient(ellipse 40% 40% at 15% 75%, rgba(200, 241, 53, 0.04) 0%, transparent 55%);
        }

        .about-hero-grid {
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(255, 255, 255, 0.018) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.018) 1px, transparent 1px);
            background-size: 80px 80px;
        }

        .about-hero-inner {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 1300px;
            margin: 0 auto;
            padding: 5rem 2.5rem 6rem;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 5rem;
            align-items: center;
        }

        .about-hero-eyebrow {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
            opacity: 0;
            animation: fadeUp 0.8s ease 0.25s forwards;
        }

        .about-hero-eyebrow .eyebrow-line {
            width: 40px;
            height: 1px;
            background: var(--accent);
            animation: expandLine 1s ease 0.5s both;
        }

        .about-hero-eyebrow .eyebrow-text {
            font-family: 'DM Mono', monospace;
            font-size: 0.72rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--accent);
        }

        .about-hero-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(4rem, 7vw, 7.5rem);
            line-height: 0.92;
            letter-spacing: 0.01em;
            color: var(--white);
            margin-bottom: 2rem;
        }

        .about-hero-title .line {
            display: block;
            overflow: hidden;
        }

        .about-hero-title .line span {
            display: block;
            transform: translateY(110%);
            animation: slideUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .about-hero-title .line:nth-child(1) span {
            animation-delay: 0.3s;
        }

        .about-hero-title .line:nth-child(2) span {
            animation-delay: 0.45s;
        }

        .about-hero-title .line:nth-child(3) span {
            animation-delay: 0.6s;
        }

        .about-hero-title .outline {
            -webkit-text-stroke: 1.5px var(--accent);
            color: transparent;
        }

        .about-hero-desc {
            font-size: 1rem;
            color: var(--text2);
            line-height: 1.85;
            max-width: 480px;
            margin-bottom: 2.5rem;
            opacity: 0;
            animation: fadeUp 0.8s ease 0.9s forwards;
        }

        .about-hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            opacity: 0;
            animation: fadeUp 0.8s ease 1.05s forwards;
        }

        .about-hero-right {
            opacity: 0;
            animation: fadeUp 0.8s ease 0.65s forwards;
        }

        .presence-card {
            background: var(--surface);
            border: 1px solid var(--border-light);
            border-radius: 6px;
            overflow: hidden;
            position: relative;
        }

        .presence-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--accent), rgba(99, 102, 241, 0.6), var(--accent));
            background-size: 200% auto;
            animation: borderTrace 3s linear infinite;
        }

        .presence-header {
            padding: 1.5rem 2rem 1rem;
            border-bottom: 1px solid var(--border);
        }

        .presence-label {
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--accent);
        }

        .presence-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.5rem;
            letter-spacing: 0.04em;
            color: var(--white);
            margin-top: 0.3rem;
        }

        .presence-item {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            padding: 1.1rem 2rem;
            border-bottom: 1px solid var(--border);
            transition: background 0.25s, transform 0.25s;
            cursor: default;
        }

        .presence-item:last-child {
            border-bottom: none;
        }

        .presence-item:hover {
            background: rgba(59, 130, 246, 0.04);
            transform: translateX(4px);
        }

        .presence-flag {
            font-size: 2rem;
            line-height: 1;
            flex-shrink: 0;
        }

        .presence-country {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.2rem;
            letter-spacing: 0.06em;
            color: var(--white);
            line-height: 1.2;
        }

        .presence-sub {
            font-family: 'DM Mono', monospace;
            font-size: 0.6rem;
            color: var(--text3);
            letter-spacing: 0.1em;
            margin-top: 0.2rem;
        }

        .presence-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--accent);
            margin-left: auto;
            flex-shrink: 0;
            animation: pulse 2.5s ease-in-out infinite;
            box-shadow: 0 0 6px rgba(59, 130, 246, 0.5);
        }

        .about-marquee {
            background: var(--accent);
            padding: 1rem 0;
            overflow: hidden;
            position: relative;
        }

        .about-marquee .marquee-track {
            animation: marquee 30s linear infinite;
            width: max-content;
            display: flex;
        }

        .about-marquee .marquee-item {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.1rem;
            letter-spacing: 0.1em;
            color: #0a0a0a;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            white-space: nowrap;
        }

        .about-marquee .marquee-sep {
            color: rgba(0, 0, 0, 0.3);
        }

        .about-mission {
            padding: 9rem 2.5rem;
            background: var(--bg2);
            position: relative;
            overflow: hidden;
        }

        .about-mission::before {
            content: '';
            position: absolute;
            top: -200px;
            right: -150px;
            width: 550px;
            height: 550px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.055) 0%, transparent 70%);
            pointer-events: none;
        }

        .about-mission::after {
            content: '';
            position: absolute;
            bottom: -150px;
            left: -100px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(200, 241, 53, 0.04) 0%, transparent 70%);
            pointer-events: none;
        }

        .mission-inner {
            max-width: 1300px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .mission-header {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: end;
            gap: 2rem;
            margin-bottom: 5rem;
            padding-bottom: 3rem;
            border-bottom: 1px solid var(--border);
        }

        .mission-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: start;
        }

        .mission-text {
            font-size: 1rem;
            color: var(--text2);
            line-height: 1.9;
            margin-bottom: 1.5rem;
        }

        .pillar {
            display: flex;
            gap: 1.5rem;
            align-items: flex-start;
            padding: 1.75rem 0;
            border-bottom: 1px solid var(--border);
        }

        .pillar:first-child {
            padding-top: 0;
        }

        .pillar:last-child {
            border-bottom: none;
        }

        .pillar-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-light);
            color: var(--accent);
            font-size: 1.1rem;
            transition: border-color 0.3s, background 0.3s, transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .pillar:hover .pillar-icon {
            border-color: var(--accent);
            background: rgba(59, 130, 246, 0.08);
            transform: rotate(8deg) scale(1.1);
        }

        .pillar-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.2rem;
            letter-spacing: 0.04em;
            color: var(--white);
            margin-bottom: 0.4rem;
        }

        .pillar-desc {
            font-size: 0.875rem;
            color: var(--text2);
            line-height: 1.75;
        }

        .about-values {
            padding: 9rem 2.5rem;
            background: var(--bg);
        }

        .values-inner {
            max-width: 1300px;
            margin: 0 auto;
        }

        .values-header {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: end;
            gap: 2rem;
            padding-bottom: 3rem;
            border-bottom: 1px solid var(--border);
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            border-left: 1px solid var(--border);
            border-top: 1px solid var(--border);
        }

        .value-card {
            padding: 3rem 2.5rem;
            border-right: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            position: relative;
            overflow: hidden;
            transition: background 0.35s, transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .value-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent);
            transition: width 0.45s;
        }

        .value-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 50% 50% at 50% 0%, rgba(59, 130, 246, 0.05) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s;
            pointer-events: none;
        }

        .value-card:hover {
            background: var(--bg2);
            transform: translateY(-4px);
        }

        .value-card:hover::before {
            width: 100%;
        }

        .value-card:hover::after {
            opacity: 1;
        }

        .value-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 5rem;
            color: rgba(59, 130, 246, 0.1);
            line-height: 1;
            margin-bottom: 1.25rem;
            transition: color 0.35s;
        }

        .value-card:hover .value-num {
            color: rgba(59, 130, 246, 0.18);
        }

        .value-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.45rem;
            letter-spacing: 0.04em;
            color: var(--white);
            margin-bottom: 0.75rem;
        }

        .value-desc {
            font-size: 0.875rem;
            color: var(--text2);
            line-height: 1.8;
        }

        .about-stats {
            background: var(--bg3);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .stats-inner {
            max-width: 1300px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }

        .astat {
            padding: 3.5rem 2rem;
            text-align: center;
            border-right: 1px solid var(--border);
            transition: background 0.3s;
        }

        .astat:last-child {
            border-right: none;
        }

        .astat:hover {
            background: rgba(59, 130, 246, 0.04);
        }

        .astat-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 4rem;
            color: var(--white);
            line-height: 1;
            margin-bottom: 0.5rem;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .astat:hover .astat-num {
            transform: scale(1.08);
        }

        .astat-num span {
            color: var(--accent);
        }

        .astat-lbl {
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--text3);
        }

        .astat-sub {
            font-size: 0.78rem;
            color: var(--text2);
            margin-top: 0.3rem;
        }

        .about-cta {
            padding: 9rem 2.5rem;
            background: #05050a;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .about-cta-bg {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 70% 60% at 50% 50%, rgba(59, 130, 246, 0.09) 0%, transparent 70%);
            pointer-events: none;
        }

        .about-cta-grid {
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(255, 255, 255, 0.015) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.015) 1px, transparent 1px);
            background-size: 80px 80px;
            pointer-events: none;
        }

        .about-cta-inner {
            position: relative;
            z-index: 1;
            max-width: 720px;
            margin: 0 auto;
        }

        .about-cta-badge {
            display: inline-block;
            background: rgba(59, 130, 246, 0.12);
            color: var(--accent2);
            border: 1px solid rgba(59, 130, 246, 0.25);
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 6px 22px;
            margin-bottom: 2rem;
        }

        .about-cta-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(3.5rem, 7vw, 6.5rem);
            line-height: 0.92;
            letter-spacing: 0.02em;
            color: var(--white);
            margin-bottom: 1.5rem;
        }

        .about-cta-title .outline {
            -webkit-text-stroke: 1.5px var(--accent);
            color: transparent;
        }

        .about-cta-desc {
            font-size: 1rem;
            color: var(--text2);
            line-height: 1.85;
            margin-bottom: 2.75rem;
            max-width: 560px;
            margin-left: auto;
            margin-right: auto;
        }

        .about-cta-btns {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .nav-active {
            color: var(--accent) !important;
        }

        .nav-active::after {
            width: 100% !important;
        }

        @media (max-width:1024px) {
            .about-hero-inner {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .mission-header,
            .values-header {
                grid-template-columns: 1fr;
            }

            .mission-body {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .values-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-inner {
                grid-template-columns: repeat(2, 1fr);
            }

            .astat {
                border-bottom: 1px solid var(--border);
            }

            .astat:nth-child(2) {
                border-right: none;
            }

            .section-desc-wrap p {
                margin-left: 0;
            }
        }

        @media (max-width:600px) {
            .about-hero-inner {
                padding: 4rem 1.25rem 5rem;
            }

            .about-mission,
            .about-values,
            .about-cta {
                padding: 6rem 1.25rem;
            }

            .values-grid {
                grid-template-columns: 1fr;
            }

            .stats-inner {
                grid-template-columns: 1fr;
            }

            .astat {
                border-right: none;
            }
        }
    </style>
</head>

<body>

    <div class="cursor" id="cursor"></div>
    <div class="cursor-ring" id="cursorRing"></div>

    <nav id="navbar">
        <a href="index.php" class="logo">CLOUD<span>edge</span></a>
        <ul class="nav-links" id="navLinks">
            <li><a href="index.php#home">Home</a></li>
            <li><a href="about.php" class="nav-active">About</a></li>
            <li><a href="index.php#services">Services</a></li>
            <li><a href="index.php#joinus">Join Us</a></li>
            <li><a href="index.php#contact">Contact</a></li>
            <li><a href="index.php#contact" class="nav-cta">Get Started</a></li>
        </ul>
        <div class="theme-toggle" id="themeToggle"></div>
        <div class="nav-toggle" id="navToggle">
            <span class="bar"></span><span class="bar"></span><span class="bar"></span>
        </div>
    </nav>

    <!-- HERO -->
    <section class="about-hero">
        <div class="about-hero-bg"></div>
        <div class="about-hero-grid"></div>
        <div class="about-hero-inner">
            <div>
                <div class="about-hero-eyebrow">
                    <span class="eyebrow-line"></span>
                    <span class="eyebrow-text">Who We Are</span>
                </div>
                <h1 class="about-hero-title">
                    <div class="line"><span>We Lead</span></div>
                    <div class="line"><span class="outline">Change,</span></div>
                    <div class="line"><span>Not Follow</span></div>
                </h1>
                <p class="about-hero-desc">
                    At CLOUDedge Tech Services, we don't just adapt to change — we lead it. With a strong footprint
                    across India and the US, we empower businesses and professionals to stay ahead with innovative
                    strategies and intelligent solutions.
                </p>
                <div class="about-hero-actions">
                    <a href="index.php#contact" class="btn-main">Work With Us <i class="fas fa-arrow-right"></i></a>
                    <a href="index.php#services" class="btn-ghost">Our Services <i class="fas fa-layer-group"></i></a>
                </div>
            </div>
            <div class="about-hero-right">
                <div class="presence-card">
                    <div class="presence-header">
                        <div class="presence-label">Our Footprint</div>
                        <div class="presence-title">Global Presence</div>
                    </div>
                    <div>
                        <div class="presence-item">
                            <div class="presence-flag">🇮🇳</div>
                            <div>
                                <div class="presence-country">India</div>
                                <div class="presence-sub">Headquarters &amp; Operations Hub</div>
                            </div>
                            <div class="presence-dot"></div>
                        </div>
                        <div class="presence-item">
                            <div class="presence-flag">🇺🇸</div>
                            <div>
                                <div class="presence-country">United States</div>
                                <div class="presence-sub">Enterprise &amp; Fortune 500 Partnerships</div>
                            </div>
                            <div class="presence-dot" style="animation-delay:1.6s"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MARQUEE -->
    <div class="about-marquee" aria-hidden="true">
        <div class="marquee-track">
            <div class="marquee-item">Precision <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Speed <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Long-Term Value <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Global Expertise <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Local Insight <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">AI-Driven Transformation <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Sustainable Advantage <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Precision <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Speed <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Long-Term Value <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Global Expertise <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Local Insight <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">AI-Driven Transformation <span class="marquee-sep">✦</span></div>
            <div class="marquee-item">Sustainable Advantage <span class="marquee-sep">✦</span></div>
        </div>
    </div>

    <!-- MISSION -->
    <section class="about-mission">
        <div class="mission-inner">
            <div class="mission-header reveal">
                <div class="section-title-wrap">
                    <div class="section-tag">Our Mission</div>
                    <h2>Driving Measurable<br>Growth, Globally</h2>
                </div>
                <div class="section-desc-wrap">
                    <p>We operate as a global consulting and technology partner committed to driving measurable outcomes
                        — combining worldwide expertise with deep local insight.</p>
                </div>
            </div>
            <div class="mission-body">
                <div class="reveal reveal-delay-1">
                    <p class="mission-text">With a strong footprint across India and the US, CLOUDedge Tech Services
                        bridges the gap between ambition and execution. We enable organizations to access the right
                        talent, advanced technology, and scalable solutions tailored to their unique goals.</p>
                    <p class="mission-text">From building high-performance teams to enabling AI-driven transformation
                        and strengthening digital ecosystems, we deliver solutions that create sustainable competitive
                        advantage — built on precision, speed, and long-term value.</p>
                    <p class="mission-text">Whether supporting agile startups or partnering with Fortune 500
                        enterprises, we align with our clients' vision and deliver excellence at every stage of their
                        journey. Always thoughtful, always measurable, always built to last.</p>
                </div>
                <div class="reveal reveal-delay-2">
                    <div class="pillar">
                        <div class="pillar-icon"><i class="fas fa-globe"></i></div>
                        <div>
                            <div class="pillar-title">Global Consulting Partner</div>
                            <p class="pillar-desc">Across three continents, we bring deep local knowledge and true
                                global scale to every client engagement.</p>
                        </div>
                    </div>
                    <div class="pillar">
                        <div class="pillar-icon"><i class="fas fa-brain"></i></div>
                        <div>
                            <div class="pillar-title">AI-Driven Transformation</div>
                            <p class="pillar-desc">Intelligent systems, automation, and data-driven decision making lie
                                at the core of every solution we build.</p>
                        </div>
                    </div>
                    <div class="pillar">
                        <div class="pillar-icon"><i class="fas fa-users-cog"></i></div>
                        <div>
                            <div class="pillar-title">Right Talent, Right Time</div>
                            <p class="pillar-desc">We connect organizations with skilled professionals who drive
                                performance, culture fit, and long-term success.</p>
                        </div>
                    </div>
                    <div class="pillar">
                        <div class="pillar-icon"><i class="fas fa-shield-alt"></i></div>
                        <div>
                            <div class="pillar-title">Secure Digital Ecosystems</div>
                            <p class="pillar-desc">Protecting infrastructure, minimizing downtime, and safeguarding
                                sensitive data at every scale of business.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- VALUES -->
    <section class="about-values">
        <div class="values-inner">
            <div class="values-header reveal">
                <div class="section-title-wrap">
                    <div class="section-tag">Our Values</div>
                    <h2>What We<br>Stand For</h2>
                </div>
                <div class="section-desc-wrap">
                    <p>These aren't slogans — they're the operating principles that guide every decision, every
                        partnership, and every solution we deliver.</p>
                </div>
            </div>
            <div class="values-grid">
                <div class="value-card reveal reveal-delay-1">
                    <div class="value-num">01</div>
                    <div class="value-title">Precision</div>
                    <p class="value-desc">Every solution we design is meticulously crafted to address the specific needs
                        of our clients. We don't believe in one-size-fits-all — we believe in exactly right.</p>
                </div>
                <div class="value-card reveal reveal-delay-2">
                    <div class="value-num">02</div>
                    <div class="value-title">Speed</div>
                    <p class="value-desc">In today's digital landscape, velocity matters. We move fast without
                        sacrificing quality, enabling our clients to seize opportunities before the competition does.
                    </p>
                </div>
                <div class="value-card reveal reveal-delay-3">
                    <div class="value-num">03</div>
                    <div class="value-title">Long-Term Value</div>
                    <p class="value-desc">We build partnerships, not transactions. Every engagement is designed to
                        create sustainable advantage that compounds over time and grows with your business.</p>
                </div>
                <div class="value-card reveal reveal-delay-1">
                    <div class="value-num">04</div>
                    <div class="value-title">Innovation</div>
                    <p class="value-desc">We lead change rather than follow it. From AI integration to next-gen digital
                        ecosystems, we're always at the frontier of what's possible.</p>
                </div>
                <div class="value-card reveal reveal-delay-2">
                    <div class="value-num">05</div>
                    <div class="value-title">Integrity</div>
                    <p class="value-desc">Transparency, accountability, and trust are non-negotiable. We say what we
                        mean, deliver what we promise, and stand behind every solution we provide.</p>
                </div>
                <div class="value-card reveal reveal-delay-3">
                    <div class="value-num">06</div>
                    <div class="value-title">Partnership</div>
                    <p class="value-desc">We align with your vision and become an extension of your team. Your goals are
                        our goals — your success is our most important metric.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS -->
    <div class="about-stats">
        <div class="stats-inner">
            <div class="astat reveal">
                <div class="astat-num" id="astat1">2<span>+</span></div>
                <div class="astat-lbl">Countries</div>
                <div class="astat-sub">India &amp; US</div>
            </div>
            <div class="astat reveal reveal-delay-1">
                <div class="astat-num" id="astat2">500<span>+</span></div>
                <div class="astat-lbl">Clients Served</div>
                <div class="astat-sub">Across 12 Industries</div>
            </div>
            <div class="astat reveal reveal-delay-2">
                <div class="astat-num" id="astat3">99.9<span>%</span></div>
                <div class="astat-lbl">Uptime Guarantee</div>
                <div class="astat-sub">SLA Backed</div>
            </div>
            <div class="astat reveal reveal-delay-3">
                <div class="astat-num" id="astat4">3<span>+</span></div>
                <div class="astat-lbl">Years Experience</div>
                <div class="astat-sub">Since 2023</div>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <section class="about-cta">
        <div class="about-cta-bg"></div>
        <div class="about-cta-grid"></div>
        <div class="about-cta-inner reveal">
            <div class="about-cta-badge">Let's Work Together</div>
            <h2 class="about-cta-title">Ready to<br><span class="outline">Lead Change?</span></h2>
            <p class="about-cta-desc">Whether you're a startup finding your footing or a Fortune 500 enterprise pushing
                new boundaries — we're ready to align with your vision and deliver excellence at every stage.</p>
            <div class="about-cta-btns">
                <a href="index.php#contact" class="btn-main">Get In Touch <i class="fas fa-arrow-right"></i></a>
                <a href="index.php#services" class="btn-ghost">Explore Services <i class="fas fa-layer-group"></i></a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-top">
            <div class="footer-brand">
                <a href="index.php" class="footer-logo">CLOUD<span>edge</span></a>
                <p>Leading global consulting and technology partner committed to driving measurable growth across India
                    and the US.</p>
            </div>
            <div class="footer-col">
                <h5>Company</h5>
                <ul>
                    <li><a href="about.php">About</a></li>
                    <li><a href="index.php#services">Services</a></li>
                    <li><a href="index.php#joinus">Careers</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
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

    <script>
        /* PAGE ENTER */
        (function () {
            function buildTransition() {
                var wrap = document.createElement('div'); wrap.className = 'page-transition'; wrap.id = 'pageTransition';
                var top = document.createElement('div'); top.className = 'pt-panel pt-top';
                var bot = document.createElement('div'); bot.className = 'pt-panel pt-bottom';
                var logo = document.createElement('div'); logo.className = 'pt-logo'; logo.id = 'ptLogo';
                logo.innerHTML = 'CLOUD<span>edge</span><span class="pt-logo-dot"></span>';
                wrap.appendChild(top); wrap.appendChild(bot);
                document.body.prepend(wrap); document.body.prepend(logo);
                return { wrap: wrap, logo: logo };
            }
            var el = buildTransition();
            el.wrap.classList.add('pt-enter');
            setTimeout(function () { el.wrap.remove(); el.logo.remove(); }, 1400);

            document.addEventListener('click', function (e) {
                var link = e.target.closest('a[href]');
                if (!link) return;
                var href = link.getAttribute('href');
                if (!href || href.startsWith('#') || link.target === '_blank' || href.startsWith('mailto:') || href.startsWith('tel:')) return;
                if (href.startsWith('http') && !href.includes(window.location.hostname)) return;
                e.preventDefault();
                var ex = buildTransition(); ex.wrap.classList.add('pt-leave');
                setTimeout(function () { window.location.href = href; }, 600);
            });
        })();

        /* CURSOR */
        const cursor = document.getElementById('cursor'), ring = document.getElementById('cursorRing');
        let mx = 0, my = 0, rx = 0, ry = 0;
        document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; cursor.style.left = mx + 'px'; cursor.style.top = my + 'px'; });
        (function animRing() { rx += (mx - rx) * 0.12; ry += (my - ry) * 0.12; ring.style.left = rx + 'px'; ring.style.top = ry + 'px'; requestAnimationFrame(animRing); })();
        document.querySelectorAll('a,button,.value-card,.pillar').forEach(el => {
            el.addEventListener('mouseenter', () => { cursor.style.width = '20px'; cursor.style.height = '20px'; ring.style.width = '60px'; ring.style.height = '60px'; ring.style.borderColor = 'rgba(200,241,53,0.6)'; });
            el.addEventListener('mouseleave', () => { cursor.style.width = '10px'; cursor.style.height = '10px'; ring.style.width = '40px'; ring.style.height = '40px'; ring.style.borderColor = 'rgba(200,241,53,0.4)'; });
        });

        /* NAVBAR */
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => navbar.classList.toggle('scrolled', window.scrollY > 50));
        const toggle = document.getElementById('navToggle'), navLinks = document.getElementById('navLinks');
        toggle.addEventListener('click', () => {
            navLinks.classList.toggle('open');
            const bars = toggle.querySelectorAll('.bar');
            if (navLinks.classList.contains('open')) { bars[0].style.transform = 'rotate(45deg) translate(5px,5px)'; bars[1].style.opacity = '0'; bars[2].style.transform = 'rotate(-45deg) translate(5px,-5px)'; }
            else { bars.forEach(b => { b.style.transform = ''; b.style.opacity = ''; }); }
        });
        navLinks.querySelectorAll('a').forEach(a => a.addEventListener('click', () => { navLinks.classList.remove('open'); toggle.querySelectorAll('.bar').forEach(b => { b.style.transform = ''; b.style.opacity = ''; }); }));

        /* SCROLL REVEAL */
        const revObs = new IntersectionObserver(entries => { entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); revObs.unobserve(e.target); } }); }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.reveal,.reveal-left,.reveal-right,.reveal-scale').forEach(el => revObs.observe(el));

        /* VALUE CARD STAGGER */
        const vcards = document.querySelectorAll('.value-card');
        const vcObs = new IntersectionObserver(entries => { entries.forEach(e => { if (e.isIntersecting) { const i = Array.from(vcards).indexOf(e.target); setTimeout(() => e.target.classList.add('visible'), i * 90); vcObs.unobserve(e.target); } }); }, { threshold: 0.1 });
        vcards.forEach(c => vcObs.observe(c));

        /* COUNTERS */
        function countTo(el, target, decimals, symbol) { const dur = 2200, start = performance.now(); function step(now) { const t = Math.min((now - start) / dur, 1), ease = 1 - Math.pow(1 - t, 4), val = target * ease, disp = decimals ? val.toFixed(decimals) : Math.floor(val); el.innerHTML = disp + '<span>' + symbol + '</span>'; if (t < 1) requestAnimationFrame(step); else { el.style.transform = 'scale(1.1)'; setTimeout(() => el.style.transform = '', 200); } } requestAnimationFrame(step); }
        const triggered = {};
        const cObs = new IntersectionObserver(entries => { entries.forEach(e => { if (e.isIntersecting && !triggered[e.target.id]) { triggered[e.target.id] = true; const id = e.target.id; if (id === 'astat1') countTo(e.target, 2, 0, '+'); if (id === 'astat2') countTo(e.target, 500, 0, '+'); if (id === 'astat3') countTo(e.target, 99.9, 1, '%'); if (id === 'astat4') countTo(e.target, 3, 0, '+'); } }); }, { threshold: 0.5 });
        ['astat1', 'astat2', 'astat3', 'astat4'].forEach(id => { const el = document.getElementById(id); if (el) cObs.observe(el); });

        /* MAGNETIC BUTTONS */
        document.querySelectorAll('.btn-main,.btn-ghost').forEach(btn => {
            btn.addEventListener('mousemove', e => { const r = btn.getBoundingClientRect(), dx = (e.clientX - r.left - r.width / 2) * 0.25, dy = (e.clientY - r.top - r.height / 2) * 0.25; btn.style.transform = `translate(${dx}px,${dy}px) translateY(-2px)`; });
            btn.addEventListener('mouseleave', () => btn.style.transform = '');
        });

        /* SCROLL PROGRESS BAR */
        const bar = document.createElement('div');
        bar.style.cssText = 'position:fixed;top:0;left:0;height:2px;width:0%;background:linear-gradient(90deg,var(--accent),#a78bfa);z-index:9999;pointer-events:none;box-shadow:0 0 8px rgba(59,130,246,0.4);transition:width 0.1s linear;';
        document.body.appendChild(bar);
        window.addEventListener('scroll', () => { const s = document.documentElement.scrollTop, m = document.documentElement.scrollHeight - window.innerHeight; bar.style.width = (m > 0 ? s / m * 100 : 0) + '%'; });

        /* PARTICLE CANVAS */
        (function () {
            const hero = document.querySelector('.about-hero'); if (!hero) return;
            const canvas = document.createElement('canvas');
            canvas.style.cssText = 'position:absolute;inset:0;pointer-events:none;z-index:1;opacity:0.45;';
            hero.appendChild(canvas);
            const ctx = canvas.getContext('2d');
            function resize() { canvas.width = hero.offsetWidth; canvas.height = hero.offsetHeight; }
            resize(); window.addEventListener('resize', resize);
            const P = [];
            class Particle { constructor() { this.reset(); } reset() { this.x = Math.random() * canvas.width; this.y = Math.random() * canvas.height; this.r = Math.random() * 1.4 + 0.3; this.vx = (Math.random() - 0.5) * 0.3; this.vy = -(Math.random() * 0.4 + 0.15); this.life = 0; this.max = Math.random() * 200 + 100; this.col = Math.random() > 0.5 ? 'rgba(59,130,246,' : 'rgba(200,241,53,'; } update() { this.x += this.vx; this.y += this.vy; this.life++; if (this.life > this.max) this.reset(); } draw() { const a = Math.sin(this.life / this.max * Math.PI) * 0.45; ctx.beginPath(); ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2); ctx.fillStyle = this.col + a + ')'; ctx.fill(); } }
            for (let i = 0; i < 55; i++) { const p = new Particle(); p.life = Math.random() * p.max; P.push(p); }
            function loop() { ctx.clearRect(0, 0, canvas.width, canvas.height); for (let i = 0; i < P.length; i++)for (let j = i + 1; j < P.length; j++) { const dx = P[i].x - P[j].x, dy = P[i].y - P[j].y, d = Math.sqrt(dx * dx + dy * dy); if (d < 80) { ctx.beginPath(); ctx.moveTo(P[i].x, P[i].y); ctx.lineTo(P[j].x, P[j].y); ctx.strokeStyle = 'rgba(59,130,246,' + (1 - d / 80) * 0.07 + ')'; ctx.lineWidth = 0.5; ctx.stroke(); } } P.forEach(p => { p.update(); p.draw(); }); requestAnimationFrame(loop); }
            loop();
            [1, 2, 3].forEach(n => { const o = document.createElement('div'); o.className = 'orb orb-' + n; hero.appendChild(o); });
        })();

        /* GLITCH */
        const fl = document.querySelector('.about-hero-title .line:first-child span');
        if (fl) { const t = fl.textContent.trim(); fl.innerHTML = '<span class="glitch-wrap" data-text="' + t + '">' + t + '</span>'; }
    </script>
    <script>
        /* THEME TOGGLE SYNC (Normal / Day) */
        (function () {
            const THEMES = ['normal', 'day'];
            const ICONS = {
                normal: '<i class="fas fa-desktop"></i>',
                day: '<i class="fas fa-sun"></i>'
            };
            const LABELS = { normal: 'Normal', day: 'Day' };

            const storedTheme = localStorage.getItem('ce-theme');
            const activeTheme = THEMES.includes(storedTheme) ? storedTheme : 'normal';
            applyTheme(activeTheme);

            document.querySelectorAll('.theme-toggle').forEach(mount => {
                if (mount.querySelector('[data-theme-btn]')) return;
                THEMES.forEach(theme => {
                    const btn = document.createElement('button');
                    btn.className = 'theme-btn' + (theme === activeTheme ? ' active' : '');
                    btn.setAttribute('aria-label', LABELS[theme] + ' mode');
                    btn.setAttribute('title', LABELS[theme]);
                    btn.setAttribute('data-theme-btn', theme);
                    btn.innerHTML = ICONS[theme];
                    btn.addEventListener('click', function () {
                        setTheme(theme);
                    });
                    mount.appendChild(btn);
                });
            });

            function setTheme(theme) {
                if (!THEMES.includes(theme)) theme = 'normal';
                applyTheme(theme);
                localStorage.setItem('ce-theme', theme);
                document.querySelectorAll('[data-theme-btn]').forEach(btn => {
                    btn.classList.toggle('active', btn.getAttribute('data-theme-btn') === theme);
                });
            }

            function applyTheme(theme) {
                if (theme === 'day') {
                    document.documentElement.setAttribute('data-theme', 'day');
                } else {
                    document.documentElement.removeAttribute('data-theme');
                }
            }
        })();
    </script>
</body>

</html>