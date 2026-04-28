<div style="display: flex; flex-wrap: nowrap; justify-content: space-between; margin-bottom: 50px">
    <img src="{{ asset('images/logos/dragon-small.png') }}" style="float:left;height:200px" alt="Golden Dragon">
    <div>
        <h2 style="margin: 0; font-size:40px;font-weight:bold;color:yellow">Chinees Indische Specialiteiten</h2>
        <h1 style="margin: 0; font-size:50px;font-weight:bold;color:yellow">De Gouden Draak</h1>

        <nav style="display: flex; justify-content: center; gap: 4px; background-color: red; padding: 5px; padding-top: 16px;">
            <a href="{{ route('public.menu') }}"
               style="color: white; text-align: center; padding: 10px 30px; background: linear-gradient(to bottom, #00ffff, #0000ff); border: 1px solid white; text-decoration: none;">
                Menukaart
            </a>
            <a href="{{ route('public.news') }}"
               style="color: white; text-align: center; padding: 10px 30px; background: linear-gradient(to bottom, #00ffff, #0000ff); border: 1px solid white; text-decoration: none;">
                Nieuws
            </a>
            <a href="{{ route('public.contact') }}"
               style="color: white; text-align: center; padding: 10px 30px; background: linear-gradient(to bottom, #00ffff, #0000ff); border: 1px solid white; text-decoration: none;">
                Contact
            </a>
        </nav>
    </div>
    <img src="{{ asset('images/logos/dragon-small-flipped.png') }}" style="float:right;height:200px" alt="Golden Dragon">
</div>
