@if(isset($bookings) && !empty($bookings))
@if($bookings)
<table>
    {{-- TODO: Consultar si deben estar visibles las columnas del encabezado
    <thead>
        <tr>
            <th>columna 0</th>
             Localizador de la estancia
            <th>columna 1</th>
             Nombre del cliente
            <th>columna 2</th>
              Apellido del cliente
            <th>columna 3</th>
              asaporte del cliente
            <th>columna 4</th>
             Fecha de nacimiento
            <th>columna 5</th>
             Código ISO de 2 letras del país de residencia
            <th>columna 6</th>
              Código del hotel
            <th>columna 7</th>
              Fecha de entrada al hotel
            <th>columna 8</th>
              Fecha de salida del hotel
            <th>columna 9</th>
             Número de habitación
        </tr>
    </thead>
    --}}
    <tbody>
        @foreach($bookings as $booking)
                    <tr>
                        <td>{{ data_get($booking, 'booking.locator') }}</td>
                        <td>{{ data_get($booking,'guest.name') }}</td>
                        <td>{{ data_get($booking,'guest.lastname') }}</td>
                        <td>{{ data_get($booking,'guest.passport') }}</td>
                        <td>{{ data_get($booking,'guest.birthdate') }}</td>
                        <td>{{ data_get($booking,'guest.country') }}</td>
                        <td>{{ data_get($booking,'hotel_id') }}</td>
                        <td>{{ data_get($booking,'booking.check_in') }}</td>
                        <td>{{ data_get($booking,'booking.check_out') }}</td>
                        <td>{{ data_get($booking,'booking.room') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endif
