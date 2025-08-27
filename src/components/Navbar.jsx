import React from "react";

const Navbar = () => {
  return (
    <nav className="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-[90%] md:w-[80%]">
      <div
        className="flex items-center justify-between 
        bg-white/30 backdrop-blur-lg border border-white/20 
        rounded-full shadow-lg px-6 py-3 transition-all duration-300"
      >
        {/* Logo */}
        <div className="flex items-center space-x-2">
          <img src="/logo.png" alt="Logo" className="w-8 h-8 object-contain" />
          <span className="font-bold text-gray-900 drop-shadow-sm">Amerta</span>
        </div>

        {/* Menu */}
        <ul className="hidden md:flex space-x-6 text-gray-900 font-medium">
          {["Beranda", "Tentang", "konten 1", "konten 2", "konsultasi", "FAQ"].map(
            (item) => {
              const id = item.toLowerCase(); // bikin id lowercase biar konsisten
              return (
                <li key={item}>
                  <a
                    href={`#${id}`}
                    className="relative transition duration-300 hover:text-[#84441E] 
          after:content-[''] after:absolute after:left-0 after:-bottom-1 
          after:h-[2px] after:w-0 after:bg-[#84441E] after:transition-all 
          after:duration-300 hover:after:w-full"
                  >
                    {item}
                  </a>
                </li>
              );
            }
          )}
        </ul>

        {/* Tombol Dashboard */}
        <a
          href="#"
          className="bg-[#84441E] hover:bg-[#6e3717] text-white font-bold 
            px-5 py-2 rounded-full transition duration-300 shadow-md"
        >
          Dashboard
        </a>
      </div>
    </nav>
  );
};

export default Navbar;
