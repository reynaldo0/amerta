import { BrowserRouter, Route, Routes } from "react-router-dom";
import Navbar from "./components/Navbar";
import FeaturesSection from "./pages/home/Feature";
import Peta from "./pages/home/Peta";
import Home from "./pages/Home";
import About from "./pages/About";
import Quiz from "./pages/quiz/question";
import Sumatera from "./pages/culture/Sumatera";
import Jawa from "./pages/culture/Jawa";
import Sulawesi from "./pages/culture/Sulawesi";
import Kalimantan from "./pages/culture/Kalimantan";
import Papua from "./pages/culture/Papua";

function App() {
  return (
    <BrowserRouter>
      <Navbar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/beranda" element={<Home />} />
        <Route path="/tentang" element={<About />} />
        <Route path="/kuis" element={<Quiz />} />
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
