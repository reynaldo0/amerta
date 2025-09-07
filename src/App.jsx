import { useEffect, useState } from "react";
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
import Article from "./pages/Article";
import ArticleDetail from "./pages/artikel/ArticleDetail";
import Footer from "./components/Footer";
import ChatBotModal from "./pages/ChatBot";
import LoadingScreen from "./Loading";

function App() {
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // Simulasi loading selama 2 detik
    const timer = setTimeout(() => {
      setLoading(false);
    }, 4000);

    return () => clearTimeout(timer);
  }, []);

  if (loading) return <LoadingScreen />;

  return (
    <BrowserRouter>
      <Navbar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/beranda" element={<Home />} />
        <Route path="/tentang" element={<About />} />
        <Route path="/artikel" element={<Article />} />
        <Route path="/artikel/:id" element={<ArticleDetail />} />
        <Route path="/komunitas" element={<Comunity />} />
        <Route path="/budaya" element={<Culture />} />
        <Route path="/budaya-sumatera" element={<Sumatera />} />
        <Route path="/budaya-jawa" element={<Jawa />} />
        <Route path="/budaya-kalimantan" element={<Kalimantan />} />
        <Route path="/budaya-sulawesi" element={<Sulawesi />} />
        <Route path="/budaya-papua" element={<Papua />} />
      </Routes>
      <ChatBotModal />
      <Footer />
    </BrowserRouter>
  );
}

export default App;
