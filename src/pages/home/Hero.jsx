import { useEffect, useState, useRef } from "react";

export default function Hero() {
  const [rawOffsetY, setRawOffsetY] = useState(0);
  const [smoothOffsetY, setSmoothOffsetY] = useState(0);
  const rafRef = useRef(null);

  useEffect(() => {
    let ticking = false;

    const handleScroll = () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          setRawOffsetY(window.scrollY);
          ticking = false;
        });
        ticking = true;
      }
    };

    window.addEventListener("scroll", handleScroll, { passive: true });
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  // Animate smoothOffsetY supaya mengejar rawOffsetY dengan easing (lerp)
  useEffect(() => {
    const lerp = (start, end, factor) => start + (end - start) * factor;

    const update = () => {
      setSmoothOffsetY((prev) => {
        const next = lerp(prev, rawOffsetY, 0.1); // 0.1 = smoothing factor (semakin kecil semakin smooth)
        return Math.abs(next - rawOffsetY) < 0.1 ? rawOffsetY : next;
      });
      rafRef.current = requestAnimationFrame(update);
    };

    rafRef.current = requestAnimationFrame(update);
    return () => cancelAnimationFrame(rafRef.current);
  }, [rawOffsetY]);

  return (
    <section className="relative h-screen w-full bg-white overflow-hidden">
      <div className="hidden sm:block top-60 absolute left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-3xl overflow-hidden transform scale-95 blur-sm opacity-60 transition-all duration-500 hover:translate-x-1 hover:translate-y-1">
        <img
          src="/indonesia.png"
          alt="Peta Indonesia"
          className="w-full h-72 object-cover animate-float"
        />
      </div>

      {/* Mobile */}
      <div className="flex -top-90 sm:hidden absolute inset-0 justify-center items-center transform scale-95 blur-sm opacity-60">
        <img
          src="/indonesia.png"
          alt="Peta Indoensia"
          className="w-full object-cover animate-float"
        />
      </div>
      {/* Background */}
      <div
        className="absolute inset-0 bg-[url('/wave/bg.svg')] bg-cover bg-center opacity-10 will-change-transform"
        style={{ backgroundAttachment: "fixed" }}
      />

      {/* Background Layer + Blur */}
      <div
        className="absolute inset-0 bg-cover bg-center will-change-transform"
        style={{
          transform: `translateY(${smoothOffsetY * 0.5}px)`,
          filter: `blur(${Math.min(smoothOffsetY * 0.02, 10)}px)`,
        }}
      />

      {/* Text Layer (pakai smoothOffsetY biar lembut) */}
      <div
        className="relative z-10 flex flex-col justify-center items-center h-full text-center px-4 will-change-transform"
        style={{ transform: `translateY(${smoothOffsetY * 0.3}px)` }}
      >
        <h1
          className="text-4xl md:text-6xl lg:text-7xl font-extrabold tracking-wider 
               bg-gradient-to-r from-primary-200 via-primary-300 to-primary-200 
               bg-clip-text text-transparent drop-shadow-lg md:pb-3"
          data-aos="zoom-in-down"
          data-aos-duration="800"
        >
          Keindahan Budaya Nusantara
        </h1>

        <p
          className="mt-6 text-lg md:text-2xl text-primary-100 max-w-2xl"
          data-aos="zoom-in-down"
          data-aos-duration="1000"
        >
          Menyelami ragam budaya dan tradisi yang membentuk identitas bangsa.
        </p>
      </div>

      {/* Wave Parallax */}
      <div className="absolute bottom-0 w-full overflow-hidden leading-[0] z-20 will-change-transform">
        <img
          src="/wave/hero.png"
          alt="Wave"
          className="w-full h-full object-cover will-change-transform"
          style={{
            transform:
              smoothOffsetY > 0
                ? `translateY(${smoothOffsetY * 0.5}px)`
                : "translateY(0)",
          }}
        />
      </div>
    </section>
  );
}
