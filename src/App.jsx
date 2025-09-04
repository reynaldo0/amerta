import { BrowserRouter, Route, Routes } from "react-router-dom";
import Navbar from "./components/Navbar";
import About from "./pages/About";
import Comunity from "./pages/Comunity";
import Culture from "./pages/Culture";
import Jawa from "./pages/culture/Jawa";
import Kalimantan from "./pages/culture/Kalimantan";
import Papua from "./pages/culture/Papua";
import Sulawesi from "./pages/culture/Sulawesi";
import Sumatera from "./pages/culture/Sumatera";
import Home from "./pages/Home";
import Article from "./pages/article";

function App() {
  return (
    <BrowserRouter>
      <Navbar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/beranda" element={<Home />} />
        <Route path="/tentang" element={<About />} />
        <Route path="/artikel" element={<Article />} />
        <Route path="/komunitas" element={<Comunity />} />
        <Route path="/budaya" element={<Culture />} />
        <Route path="/budaya-sumatera" element={<Sumatera />} />
        <Route path="/budaya-jawa" element={<Jawa />} />
        <Route path="/budaya-kalimantan" element={<Kalimantan />} />
        <Route path="/budaya-sulawesi" element={<Sulawesi />} />
        <Route path="/budaya-papua" element={<Papua />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
