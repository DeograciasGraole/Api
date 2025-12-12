<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Graolng - Master Languages, Master Your Future</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
          Oxygen, Ubuntu, Cantarell, sans-serif;
        background-color: #0a0a0a;
        color: #fff;
        line-height: 1.6;
        overflow-x: hidden;
        position: relative;
      }

      /* Animated background particles */
      .bg-particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;
      }

      .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: radial-gradient(
          circle,
          rgba(59, 130, 246, 0.8),
          transparent
        );
        border-radius: 50%;
        animation: float 20s infinite;
      }

      @keyframes float {
        0%,
        100% {
          transform: translate(0, 0) scale(1);
          opacity: 0.3;
        }
        50% {
          transform: translate(100px, -100px) scale(1.5);
          opacity: 0.8;
        }
      }

      /* Floating math expressions */
      .math-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
        opacity: 0.1;
      }

      .math-expression {
        position: absolute;
        color: rgba(255, 255, 255, 0.3);
        font-size: 1.5rem;
        font-family: "Courier New", monospace;
        animation: drift 30s infinite linear;
      }

      @keyframes drift {
        from {
          transform: translateY(100vh) rotate(0deg);
        }
        to {
          transform: translateY(-100vh) rotate(360deg);
        }
      }

      /* Header */
      header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 5%;
        position: sticky;
        top: 0;
        background-color: rgba(10, 10, 10, 0.95);
        z-index: 1000;
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(59, 130, 246, 0.1);
      }

      .logo {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.75rem;
        font-weight: bold;
      }

      .logo-fx {
        color: #3b82f6;
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
      }

      .logo-text {
        color: #fff;
      }

      nav {
        display: flex;
        align-items: center;
        gap: 2rem;
      }

      .nav-links {
        display: flex;
        gap: 2rem;
        list-style: none;
      }

      .nav-links a {
        color: #fff;
        text-decoration: none;
        font-size: 0.95rem;
        transition: color 0.3s;
        position: relative;
      }

      .nav-links a:hover {
        color: #3b82f6;
      }

      .nav-links a.active {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        padding: 0.5rem 1rem;
        border-radius: 6px;
        color: #fff;
      }

      .header-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
      }

      .btn-login {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.3s;
      }

      .btn-login:hover {
        border-color: #3b82f6;
        color: #3b82f6;
      }

      .language-selector {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        padding: 0.6rem 1rem;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.3s;
      }

      .language-selector:hover {
        border-color: #3b82f6;
      }

      .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #fff;
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.9rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
      }

      .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
      }

      .btn-outline {
        background: transparent;
        border: 1px solid #fff;
        color: #fff;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.3s;
      }

      .btn-outline:hover {
        background: rgba(255, 255, 255, 0.1);
      }

      /* Hero Section */
      .hero {
        position: relative;
        z-index: 1;
        text-align: center;
        padding: 8rem 5% 6rem;
        max-width: 1400px;
        margin: 0 auto;
      }

      .tagline {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 2rem;
      }

      .tagline-icon {
        width: 20px;
        height: 20px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border-radius: 50%;
      }

      .headline {
        font-size: clamp(3rem, 10vw, 6rem);
        font-weight: 900;
        margin-bottom: 1.5rem;
        line-height: 1.1;
      }

      .headline-part1 {
        color: #fff;
      }

      .headline-part2 {
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
      }

      .sub-headline {
        font-size: clamp(2rem, 6vw, 4rem);
        font-weight: 700;
        color: #fff;
        margin-bottom: 3rem;
      }

      .features-row {
        display: flex;
        justify-content: center;
        gap: 3rem;
        flex-wrap: wrap;
        margin-bottom: 4rem;
      }

      .feature-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #fff;
      }

      .feature-icon {
        width: 24px;
        height: 24px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
      }

      .feature-icon svg {
        width: 16px;
        height: 16px;
        fill: #fff;
      }

      .feature-text {
        font-size: 0.95rem;
      }

      .cta-buttons {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        flex-wrap: wrap;
      }

      /* Footer */
      footer {
        position: relative;
        z-index: 1;
        padding: 2rem 5%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid rgba(59, 130, 246, 0.1);
      }

      .footer-left {
        display: flex;
        align-items: center;
        gap: 1.5rem;
      }

      .footer-left span {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
      }

      .social-icons {
        display: flex;
        gap: 1rem;
      }

      .social-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
      }

      .social-icon:hover {
        background: rgba(59, 130, 246, 0.2);
        border-color: #3b82f6;
        transform: translateY(-2px);
      }

      .social-icon svg {
        width: 20px;
        height: 20px;
        fill: #fff;
      }

      .footer-right {
        display: flex;
        align-items: center;
        gap: 1rem;
      }

      .scroll-hint {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.85rem;
      }

      .expand-icon {
        width: 40px;
        height: 40px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
      }

      .expand-icon:hover {
        border-color: #3b82f6;
        background: rgba(59, 130, 246, 0.1);
      }

      .expand-icon svg {
        width: 20px;
        height: 20px;
        fill: #fff;
      }

      /* Cookie Banner */
      .cookie-banner {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(20, 20, 20, 0.95);
        backdrop-filter: blur(10px);
        border-top: 1px solid rgba(59, 130, 246, 0.2);
        padding: 1.5rem 5%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 2000;
        gap: 2rem;
      }

      .cookie-text {
        flex: 1;
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        line-height: 1.6;
      }

      .cookie-actions {
        display: flex;
        gap: 1rem;
      }

      .cookie-btn {
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: transparent;
        color: #fff;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.3s;
      }

      .cookie-btn:hover {
        border-color: #3b82f6;
        color: #3b82f6;
      }

      .cookie-btn.accept {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border: none;
        color: #fff;
      }

      .cookie-btn.accept:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
      }

      /* Responsive Design */
      @media (max-width: 1024px) {
        .nav-links {
          display: none;
        }

        .header-actions {
          gap: 0.5rem;
        }

        .btn-outline {
          display: none;
        }
      }

      @media (max-width: 768px) {
        header {
          padding: 1rem 3%;
        }

        .logo {
          font-size: 1.5rem;
        }

        .hero {
          padding: 4rem 3% 4rem;
        }

        .features-row {
          flex-direction: column;
          gap: 1.5rem;
          align-items: center;
        }

        .cta-buttons {
          flex-direction: column;
          width: 100%;
        }

        .btn-primary,
        .btn-outline {
          width: 100%;
          justify-content: center;
        }

        footer {
          flex-direction: column;
          gap: 1.5rem;
          text-align: center;
        }

        .cookie-banner {
          flex-direction: column;
          padding: 1.5rem 3%;
        }

        .cookie-actions {
          width: 100%;
        }

        .cookie-btn {
          flex: 1;
        }
      }

      @media (max-width: 480px) {
        .header-actions {
          flex-wrap: wrap;
        }

        .language-selector {
          display: none;
        }

        .headline {
          font-size: 2.5rem;
        }

        .sub-headline {
          font-size: 1.75rem;
        }
      }

      /* Glow effects */
      .glow {
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(
          circle,
          rgba(59, 130, 246, 0.3),
          transparent
        );
        border-radius: 50%;
        filter: blur(80px);
        pointer-events: none;
        z-index: 0;
      }

      .glow-1 {
        top: 10%;
        left: 10%;
        animation: pulse 4s ease-in-out infinite;
      }

      .glow-2 {
        bottom: 10%;
        right: 10%;
        animation: pulse 4s ease-in-out infinite 2s;
      }

      @keyframes pulse {
        0%,
        100% {
          opacity: 0.3;
          transform: scale(1);
        }
        50% {
          opacity: 0.6;
          transform: scale(1.1);
        }
      }
    </style>
  </head>
  <body>
    <!-- Background Effects -->
    <div class="bg-particles" id="particles"></div>
    <div class="math-bg" id="mathBg"></div>
    <div class="glow glow-1"></div>
    <div class="glow glow-2"></div>

    <!-- Header -->
    <header>
      <div class="logo">
        <span class="logo-fx">Gra</span>
        <span class="logo-text">olng</span>
      </div>
      <nav>
        <ul class="nav-links">
          <li><a href="#" class="active">Home</a></li>
          <li><a href="#">How It Works</a></li>
          <li><a href="#">Programs</a></li>
          <li><a href="#">Support</a></li>
          <li><a href="#">Careers</a></li>
          <li><a href="#">Become a Partner</a></li>
        </ul>
        <div class="header-actions">
          <button class="btn-login">Login/Register</button>
          <div class="language-selector">
            <svg
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
            >
              <circle cx="12" cy="12" r="10"></circle>
              <line x1="2" y1="12" x2="22" y2="12"></line>
              <path
                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"
              ></path>
            </svg>
            <span>English</span>
          </div>
          <button class="btn-primary">
            Start Learning
            <svg
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
            >
              <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
          </button>
          <button class="btn-outline">Free Trial</button>
        </div>
      </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
      <div class="tagline">
        <span>Your Journey, Your Success</span>
        <div class="tagline-icon"></div>
      </div>
      <h1 class="headline">
        <span class="headline-part1">Master Languages</span>
        <br />
        <span class="headline-part2">Master Your Future</span>
      </h1>
      <h2 class="sub-headline">Conquer new languages</h2>

      <div class="features-row">
        <div class="feature-item">
          <div class="feature-icon">
            <svg viewBox="0 0 24 24">
              <path
                d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4M12,6A6,6 0 0,0 6,12A6,6 0 0,0 12,18A6,6 0 0,0 18,12A6,6 0 0,0 12,6M12,8A4,4 0 0,1 16,12A4,4 0 0,1 12,16A4,4 0 0,1 8,12A4,4 0 0,1 12,8Z"
              />
            </svg>
          </div>
          <span class="feature-text">Graolng™ Native Platform</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon">
            <svg viewBox="0 0 24 24">
              <path
                d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z"
              />
            </svg>
          </div>
          <span class="feature-text">Fast Progress</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon">
            <svg viewBox="0 0 24 24">
              <path
                d="M12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22C6.47,22 2,17.5 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z"
              />
            </svg>
          </div>
          <span class="feature-text">Learn at Your Pace</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon">
            <svg viewBox="0 0 24 24">
              <path
                d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4M11,6.5V11H5.5V12.5H11V17H12.5V12.5H18.5V11H12.5V6.5H11Z"
              />
            </svg>
          </div>
          <span class="feature-text">Unique Program</span>
        </div>
      </div>

      <div class="cta-buttons">
        <button class="btn-primary" style="font-size: 1rem; padding: 1rem 2rem">
          Start Learning
          <svg
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
          >
            <path d="M5 12h14M12 5l7 7-7 7"></path>
          </svg>
        </button>
        <button class="btn-outline" style="font-size: 1rem; padding: 1rem 2rem">
          Free Trial
        </button>
      </div>
    </section>

    <!-- Footer -->
    <footer>
      <div class="footer-left">
        <span>Follow Us</span>
        <div class="social-icons">
          <div class="social-icon">
            <svg viewBox="0 0 24 24">
              <path
                d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z"
              />
            </svg>
          </div>
          <div class="social-icon">
            <svg viewBox="0 0 24 24">
              <path
                d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 2.96,4.46C2.62,5.03 2.42,5.7 2.42,6.41C2.42,7.73 3.17,8.87 4.27,9.5C3.62,9.5 3,9.3 2.48,9C2.48,9 2.48,9 2.48,9.03C2.48,11.11 3.86,12.85 5.78,13.24C5.45,13.34 5.1,13.39 4.75,13.39C4.5,13.39 4.26,13.36 4.03,13.31C4.52,15.03 6.08,16.26 7.94,16.29C6.49,17.4 4.6,18.07 2.56,18.07C2.22,18.07 1.88,18.04 1.54,18C3.44,19.16 5.7,19.85 8.12,19.85C16,19.85 20.33,13.46 20.33,7.79C20.33,7.6 20.33,7.42 20.32,7.23C21.16,6.63 21.88,5.87 22.46,6Z"
              />
            </svg>
          </div>
          <div class="social-icon">
            <svg viewBox="0 0 24 24">
              <path
                d="M12,2.163c3.204,0 3.584,0.012 4.85,0.07 3.252,0.148 4.771,1.691 4.919,4.919 0.058,1.265 0.069,1.645 0.069,4.849 0,3.205 -0.012,3.584 -0.069,4.849 -0.148,3.225 -1.664,4.771 -4.919,4.919 -1.266,0.058 -1.644,0.07 -4.85,0.07 -3.204,0 -3.584,-0.012 -4.849,-0.07 -3.26,-0.148 -4.771,-1.699 -4.919,-4.92 -0.058,-1.265 -0.07,-1.644 -0.07,-4.849 0,-3.204 0.013,-3.583 0.07,-4.849 0.148,-3.227 1.664,-4.771 4.919,-4.919 1.266,-0.058 1.645,-0.07 4.849,-0.07zm0,-2.163c-3.259,0 -3.667,0.014 -4.947,0.072 -4.358,0.198 -6.78,2.618 -6.98,6.98 -0.059,1.281 -0.073,1.689 -0.073,4.948 0,3.259 0.014,3.668 0.072,4.948 0.196,4.354 2.617,6.78 6.98,6.98 1.281,0.058 1.689,0.072 4.948,0.072 3.259,0 3.668,-0.014 4.948,-0.072 4.354,-0.2 6.782,-2.618 6.98,-6.98 0.059,-1.28 0.073,-1.689 0.073,-4.948 0,-3.259 -0.014,-3.667 -0.072,-4.947 -0.196,-4.354 -2.617,-6.78 -6.98,-6.98 -1.281,-0.059 -1.69,-0.073 -4.949,-0.073zm0,5.838c-3.403,0 -6.162,2.759 -6.162,6.162 0,3.403 2.759,6.162 6.162,6.162 3.403,0 6.162,-2.759 6.162,-6.162 0,-3.403 -2.759,-6.162 -6.162,-6.162zm0,10.162c-2.209,0 -4,-1.79 -4,-4 0,-2.209 1.791,-4 4,-4 2.209,0 4,1.791 4,4 0,2.21 -1.791,4 -4,4zm6.406,-11.845c-0.796,0 -1.441,-0.645 -1.441,-1.44 0,-0.796 0.645,-1.44 1.441,-1.44 0.795,0 1.44,0.645 1.44,1.44 0,0.795 -0.645,1.44 -1.44,1.44z"
              />
            </svg>
          </div>
          <div class="social-icon">
            <svg viewBox="0 0 24 24">
              <path
                d="M19,3A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3H19M18.5,18.5V13.2A3.26,3.26 0 0,0 15.24,9.94C14.39,9.94 13.4,10.46 12.92,11.24V10.13H10.13V18.5H12.92V13.57C12.92,12.8 13.54,12.17 14.31,12.17A1.4,1.4 0 0,1 15.71,13.57V18.5H18.5M6.88,8.56A1.68,1.68 0 0,0 8.56,6.88C8.56,5.95 7.81,5.19 6.88,5.19A1.69,1.69 0 0,0 5.19,6.88C5.19,7.81 5.95,8.56 6.88,8.56M8.27,18.5V10.13H5.5V18.5H8.27Z"
              />
            </svg>
          </div>
          <div class="social-icon">
            <svg viewBox="0 0 24 24">
              <path
                d="M12,0C5.373,0 0,5.373 0,12c0,5.302 3.438,9.8 8.207,11.387c0.599,0.111 0.82,-0.261 0.82,-0.577c0,-0.285 -0.01,-1.04 -0.015,-2.04c-3.338,0.724 -4.042,-1.61 -4.042,-1.61c-0.546,-1.387 -1.333,-1.756 -1.333,-1.756c-1.089,-0.745 0.083,-0.729 0.083,-0.729c1.205,0.084 1.839,1.237 1.839,1.237c1.07,1.834 2.807,1.304 3.492,0.997c0.107,-0.775 0.418,-1.305 0.762,-1.604c-2.665,-0.303 -5.467,-1.333 -5.467,-5.931c0,-1.311 0.469,-2.381 1.236,-3.221c-0.124,-0.303 -0.535,-1.524 0.117,-3.176c0,0 1.008,-0.322 3.301,1.23c0.957,-0.266 1.983,-0.399 3.003,-0.404c1.02,0.005 2.047,0.138 3.006,0.404c2.291,-1.552 3.297,-1.23 3.297,-1.23c0.653,1.653 0.242,2.874 0.118,3.176c0.77,0.84 1.235,1.911 1.235,3.221c0,4.609 -2.807,5.624 -5.479,5.921c0.43,0.372 0.823,1.102 0.823,2.222c0,1.606 -0.015,2.898 -0.015,3.293c0,0.319 0.192,0.694 0.801,0.576C20.566,21.797 24,17.3 24,12C24,5.373 18.627,0 12,0z"
              />
            </svg>
          </div>
        </div>
      </div>
      <div class="footer-right">
        <span class="scroll-hint">Scroll to explore</span>
        <div class="expand-icon">
          <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
          >
            <path
              d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"
            ></path>
          </svg>
        </div>
      </div>
    </footer>

    <!-- Cookie Banner -->
    <div class="cookie-banner" id="cookieBanner">
      <div class="cookie-text">
        We use cookies and other technology to provide you with our services and
        for functional, analytical and advertising purposes. Please read our
        Privacy Policy for more information.
      </div>
      <div class="cookie-actions">
        <button class="cookie-btn" onclick="declineCookies()">Decline</button>
        <button class="cookie-btn accept" onclick="acceptCookies()">
          Accept
        </button>
      </div>
    </div>

    <script>
      // Create floating particles
      function createParticles() {
        const container = document.getElementById("particles");
        for (let i = 0; i < 50; i++) {
          const particle = document.createElement("div");
          particle.className = "particle";
          particle.style.left = Math.random() * 100 + "%";
          particle.style.top = Math.random() * 100 + "%";
          particle.style.animationDelay = Math.random() * 20 + "s";
          particle.style.animationDuration = 15 + Math.random() * 10 + "s";
          container.appendChild(particle);
        }
      }

      // Create floating math expressions
      function createMathExpressions() {
        const container = document.getElementById("mathBg");
        const expressions = [
          "(12+12)",
          "-15+6",
          "3y",
          "17+6-4",
          "√(5x9)/8",
          "24",
          "12",
          "x²",
          "π",
          "∫",
        ];

        expressions.forEach((expr, index) => {
          const math = document.createElement("div");
          math.className = "math-expression";
          math.textContent = expr;
          math.style.left = index * 10 + Math.random() * 10 + "%";
          math.style.animationDelay = index * 3 + "s";
          math.style.animationDuration = 20 + Math.random() * 20 + "s";
          container.appendChild(math);
        });
      }

      // Cookie banner functionality
      function acceptCookies() {
        localStorage.setItem("cookiesAccepted", "true");
        document.getElementById("cookieBanner").style.display = "none";
      }

      function declineCookies() {
        localStorage.setItem("cookiesAccepted", "false");
        document.getElementById("cookieBanner").style.display = "none";
      }

      // Check if cookies were already accepted
      if (localStorage.getItem("cookiesAccepted")) {
        document.getElementById("cookieBanner").style.display = "none";
      }

      // Smooth scroll
      document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute("href"));
          if (target) {
            target.scrollIntoView({
              behavior: "smooth",
              block: "start",
            });
          }
        });
      });

      // Initialize on load
      document.addEventListener("DOMContentLoaded", function () {
        createParticles();
        createMathExpressions();
      });

      // Parallax effect for hero section
      window.addEventListener("scroll", () => {
        const scrolled = window.pageYOffset;
        const hero = document.querySelector(".hero");
        if (hero) {
          hero.style.transform = `translateY(${scrolled * 0.5}px)`;
          hero.style.opacity = 1 - scrolled / 500;
        }
      });
    </script>
  </body>
</html>
